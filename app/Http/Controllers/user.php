<?php

namespace App\Http\Controllers;

use Akaunting\Money\Money;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\User as Modaluser;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\t_dosen;
use App\Models\t_mahasiswa;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use App\Models\customer;

use Illuminate\Support\Facades\Auth;

class user extends Controller
{
    public function pelanggan()
    {
        if (request()->ajax()) {
            return Datatables::of(customer::get())->addIndexColumn()->addColumn('aksi', function ($data) {
                $dataj = json_encode($data);

                $btn = "      <ul class='list-inline mb-0'>
                <li class='list-inline-item'>
                <button type='button' data-toggle='modal' onclick='ubahnama(" . $dataj . ")'  class='btn btn-secondary btn-xs mb-1'><i class='simple-icon-plus'></i></button>
                </li>
           
           
            </ul>";
                return $btn;
            })->addColumn('kreditnya', function ($data) {
                $btn = Money::IDR($data->kredit_c, true);
                return $btn;
            })->addColumn('debitnya', function ($data) {
                $btn = Money::IDR($data->debit_c, true);
                return $btn;
            })->rawColumns(['aksi', 'status', 'nama', 'kreditnya', 'debitnya'])->make(true);
        }
    }
    public function foto(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'thumbnail' => 'mimes:jpeg,png,jpg|max:400',
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        if (request()->file('thumbnail')) {
            $gmbr = request()->file('thumbnail');

            $nama_file = str_replace(' ', '_', time() . "_" . $gmbr->getClientOriginalName());
            $tujuan_upload = 'image/fotomhs/';
            $gmbr->move($tujuan_upload, $nama_file);
        }
        $save = Modaluser::where('username', Auth::user()->username)->update(
            [
                'foto' => $nama_file ?? null,
            ]
        );
        if ($save) {
            return 'success';
        }
    }
    public function password(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|min:3|confirmed',
            'password_confirmation' => 'required|min:3'
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }

        $save = Modaluser::where('username', Auth::user()->username)->update(
            [
                'password' => hash::make(request()->input('password')),
            ]
        );
        if ($save) {
            return 'success';
        }
    }
    public function apimahasiswa($angkatan)
    {

        $response = Http::asForm()->post('http://apisia.unm.ac.id/mahasiswa-fakultas?app=sikemal&h=sikemal-apisia-4666888a4717b6e14904', [
            'angkatan' => $angkatan,
            'fakultas' => '03',
            'prodi' => '83207'
        ]);
        $data = json_decode($response);
        set_time_limit(0);
        return $data;

        // foreach ($data->data as $val) {
        //     if ($val->C_KODE_STATUS_AKTIF_MHS != "L") {
        //         $arrp[] = $val;
        //         t_mahasiswa::updateOrCreate([
        //             'nim' => $val->C_NPM,
        //         ], [
        //             'nama' => $val->NAMA_MAHASISWA,
        //             "angkatan" => $val->TAHUN_MASUK,
        //             'status' => $val->C_KODE_STATUS_AKTIF_MHS,
        //             'prodi' => $val->NAMA_PRODI,
        //             'email' => $val->EMAIL,
        //             'no_hp' => $val->NO_HP
        //         ]);
        //         Modaluser::updateOrCreate([
        //             'username' => $val->C_NPM,
        //         ], [
        //             'name' => $val->NAMA_MAHASISWA,
        //             'email' =>  $val->C_NPM,
        //             'password' => Hash::make(12345),
        //             'role' => 3,
        //             'status' => $val->C_KODE_STATUS_AKTIF_MHS,
        //         ]);
        //     }
        // }

        return json_encode([
            'sukses' => true,
            'dataTotal' => $data->jumlah_mhs,
            'result' => 'success',
        ]);
    }
 
    public function adminhapus($id)
    {
        $res = Modaluser::findOrFail($id);
        if ($res) {
            $res->delete();
            return "success";
        }
        return "fail";
    }
   
   
    public function adminedit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255'],
            'email' => ['string', 'email', 'max:255'],
            'no' => ['max:14'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $user = Modaluser::updateOrCreate(['id' => $request->id], [
            'name' => $request->nama,
            'email' => $request->email,
            'no_hp' => $request->no,
            'username' => $request->username,
            'status' => $request->status == 'on' ? 1 : 0,
          
        ]);
        if ($request->pass == 'on') {
            $user = Modaluser::updateOrCreate(['id' => $request->id], [
                'password' => Hash::make('password'),
            ]);
        }
        if ($user) {
            return 'success';
        }
    }
  

    public function adminsave(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],

            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['string', 'email', 'max:255'],
            'no' => ['max:14'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }

        $user = Modaluser::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make('password'),
            'no_hp' => $request->no,
            'username' => $request->username,
            'status' => $request->status == 'on' ? 1 : 0,
            'role' => $request->role,
            'foto' => null,
        ]);
        if ($user) {
            return 'success';
        }
    }
  
    public function admin()
    {
        if (request()->ajax()) {
            return Datatables::of(Modaluser::where('role',1)->orWhere('role',2)->get())->addIndexColumn()->addColumn('nama', function ($data) {
                $btn =  ' <div class="media d-flex align-items-center">
               <img src="' . asset('image/fotomhs') . '/' . ($data->foto ?? 'none.jpg') . '" width="20%" alt="table-user" class="mr-3 rounded-circle avatar-sm">
               <div class="">
                   <h6 class=""><a href="javascript:void(0);" class="text-dark">' . $data->name . '</a></h6>
               </div>
           </div>';
                return $btn;
            })->addColumn('aksi', function ($data) {
                $dataj = json_encode($data);

                $btn = "      <ul class='list-inline mb-0'>
                <li class='list-inline-item'>
                <button type='button' data-toggle='modal' onclick='upd(" . $dataj . ")' data-backdrop='static' data-target='#exampleModalRightu' class='btn btn-secondary btn-xs mb-1'><i class='simple-icon-note'></i></button>
                </li>
                <li class='list-inline-item'>
                <button type='button' onclick='del(" . $data->id . ")' class='btn btn-danger btn-xs mb-1'><i class='simple-icon-trash'></i></button>
                </li>
           
            </ul>";
                return $btn;
            })->addColumn('status', function ($data) {
                if ($data->status == 1) {
                    return '<span class="badge badge-primary">Aktif</span>';
                } else {
                    return '<span class="badge badge-warning">Non</span>';
                }
            })->addColumn('tanggal', function ($data) {
                return date("d-m-Y", strtotime($data->updated_at));
            })->addColumn('role', function ($data) {
                if ($data->role == 1) {
                    return '<span class="badge badge-info">Super Admin</span>';
                } 
                if($data->role == 2) {
                    return '<span class="badge badge-warning">Operator</span>';
                }
            })->rawColumns(['aksi', 'status', 'nama', 'tanggal', 'role'])->make(true);
        }
        return view('admin.data.admin');
    }
  

}
