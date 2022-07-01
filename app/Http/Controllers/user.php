<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\User as Modaluser;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Models\t_dosen;
use App\Models\t_mahasiswa;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class user extends Controller
{
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
        $save = user::where('username', Auth::user()->username)->update(
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

        $save = User::where('username', Auth::user()->username)->update(
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
    public function apidosen()
    {
        $arrContextOptions = array(
            "ssl" => array(
                "verify_peer" => false,
                "verify_peer_name" => false,
            ),
        );
        $response = file_get_contents("https://simpeg.unm.ac.id/api-pegawai", false, stream_context_create($arrContextOptions));
        $arrp = [];
        $data = json_decode($response);
        set_time_limit(0);

        foreach ($data as $val) {
            if ($val->unit == "Fakultas Teknik" && $val->jenis_kepegawaian == 'dosen' && $val->ket == 'Aktif') {
                $arrp[] = $val;
                t_dosen::updateOrCreate([
                    'id_dosen' => $val->id_pegawai,
                ], [
                    'nama' => $val->nama,
                    'nip' => $val->nip,
                    'alamat' => $val->alamat,
                    'no_hp' => $val->no_hp,
                    'email' => $val->email,
                    'jk' => $val->jk,
                    'foto' => $val->foto,
                ]);
                Modaluser::updateOrCreate([
                    'username' => $val->nip,
                ], [
                    'name' => $val->nama,
                    'email' => $val->email,
                    'password' => Hash::make(12345),
                    'role' => 2,
                    'status' => '1'
                ]);
            }
        }
        return 'success';
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
    public function mahasiswahapus($id)
    {
        Cache::forget('mahasiswa');

        $res = Modaluser::where('username', $id)->first();
        t_mahasiswa::where('nim', $id)->delete();
        if ($res) {
            $res->delete();
            return "success";
        }
        return "fail";
    }
    public function dosenhapus($id)
    {
        Cache::forget('dosen');
        $res = Modaluser::where('username', $id)->first();
        t_dosen::where('nip', $id)->delete();
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
            'role' => 0,
            'foto' => null,
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
    public function mahasiswaedit(Request $request)
    {
        Cache::forget('mahasiswa');
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'prodi' => ['string', 'max:255'],
            'angkatan' => ['max:14'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        if ($request->password != null) {
            $user = Modaluser::where('username', $request->username)->update([
                'name' => $request->nama,
                'email' => $request->username,
                'password' => Hash::make('password'),
                'no_hp' => $request->no,
                'username' => $request->username,
                'status' => 1,
                'role' => 3,
                'foto' => null,
            ]);
        } else {
            $user = Modaluser::where('username', $request->username)->update([
                'name' => $request->nama,
                'email' => $request->username,
                'no_hp' => $request->no,
                'username' => $request->username,
                'status' => 1,
                'role' => 3,
                'foto' => null,
            ]);
        }

        t_mahasiswa::where('nim', $request->id)->update([
            'nama' => $request->nama,
            'nim' => $request->username,
            'prodi' => $request->prodi,
            'angkatan' => $request->angkatan,
            'email' => $request->email,
            'no_hp' => $request->no,
            'status' => 'A',
            'pa' => null,
            'foto' => null
        ]);
        if ($user) {
            return 'success';
        }
    }
    public function dosenedit(Request $request)
    {
        Cache::forget('dosen');
        $validator = Validator::make($request->all(), [
            'nama' => ['required', 'string', 'max:255'],
            'alamat' => ['max:100'],
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        if ($request->password != null) {
            $user = Modaluser::where('username', $request->username)->update([
                'name' => $request->nama,
                'email' => $request->email,
                'password' => Hash::make('password'),
                'no_hp' => $request->no,
                'username' => $request->username,
                'status' => 1,
                'role' => 2,
                'foto' => null,
            ]);
        } else {
            $user = Modaluser::where('username', $request->username)->update([
                'name' => $request->nama,
                'email' => $request->email,
                'no_hp' => $request->no,
                'username' => $request->username,
                'status' => 1,
                'role' => 2,
                'foto' => null,
            ]);
        }

        t_dosen::where('id', $request->id)->update([
            'nama' => $request->nama,
            'nip' => $request->username,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'no_hp' => $request->no,

        ]);
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
            return Datatables::of(Modaluser::get())->addIndexColumn()->addColumn('nama', function ($data) {
                $btn =  ' <div class="media d-flex align-items-center">
               <img src="' . asset('image/fotoadmin') . '/' . ($data->foto ?? 'none.jpg') . '" width="20%" alt="table-user" class="mr-3 rounded-circle avatar-sm">
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
                } else {
                    return '<span class="badge badge-warning">Operator</span>';
                }
            })->rawColumns(['aksi', 'status', 'nama', 'tanggal', 'role'])->make(true);
        }
        return view('admin.data.admin');
    }
    public function dosen()
    {
        if (request()->ajax()) {
            return Datatables::of(Cache::remember('dosen', 600, function () {
                return t_dosen::all();
            }))->addIndexColumn()->addColumn('aksi', function ($data) {
                $dataj = json_encode($data);

                $btn = "      <ul class='list-inline mb-0'>
                <li class='list-inline-item'>
                <button type='button' data-toggle='modal' onclick='upd(" . $dataj . ")' data-backdrop='static' data-target='#exampleModalRightu' class='btn btn-secondary btn-xs mb-1'><i class='simple-icon-eye'></i></button>
                </li>
                <li class='list-inline-item'>
                <button type='button' onclick='del(" . json_encode($data->nip) . ")' class='btn btn-danger btn-xs mb-1'><i class='simple-icon-trash'></i></button>
                </li>
           
            </ul>";
                return $btn;
            })->rawColumns(['aksi'])->make(true);
        }
        return view('admin.data.dosen');
    }
    public function mahasiswa()
    {
        if (request()->ajax()) {
            return Datatables::of(Cache::remember('mahasiswa', 600, function () {
                return t_mahasiswa::all();
            }))->addIndexColumn()->addColumn('aksi', function ($data) {
                $dataj = json_encode($data);

                $btn = "      <ul class='list-inline mb-0'>
                <li class='list-inline-item'>
                <button type='button' data-toggle='modal' onclick='upd(" . $dataj . ")' data-backdrop='static' data-target='#exampleModalRightu' class='btn btn-secondary btn-xs mb-1'><i class='simple-icon-eye'></i></button>
                </li>
                <li class='list-inline-item'>
                <button type='button' onclick='del(" . $data->nim . ")' class='btn btn-danger btn-xs mb-1'><i class='simple-icon-trash'></i></button>
                </li>
                </ul>";
                return $btn;
            })->rawColumns(['aksi'])->make(true);
        }
        return view('admin.data.mahasiswa');
    }
}
