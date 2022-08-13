<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use App\Models\Barang;
use App\Models\Costumer;
use App\Models\customer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CostumerController extends Controller
{
    public function customer()
    {
        if (request()->ajax()) {
            return Datatables::of(customer::get())
                ->addIndexColumn()
                //         ->addColumn('namanya', function ($data) {
                //             $btn =
                //                 '<div class="media d-flex align-items-center">
                //        <img src="' .
                //                 url('image/produk') .
                //                 '/' .
                //                 ($data->gambar ?? 'none.jpg') .
                //                 '" width="40%" alt="table-user" class="mr-3 rounded-circle avatar-sm">
                //        <div class="">
                //            <h6 class=""><a href="javascript:void(0);" class="text-dark">' .
                //                 $data->nama .
                //                 '</a></h6>
                //        </div>
                //    </div>';
                //             return $btn;
                //         })
                ->addColumn('aksi', function ($data) {
                    $dataj = json_encode($data);

                    $btn =
                        "      <ul class='list-inline mb-0'>
                <li class='list-inline-item'>
                <button type='button' data-toggle='modal' onclick='upd(" .
                        $dataj .
                        ")' data-backdrop='static' data-target='#exampleModalRightu' class='btn btn-secondary btn-xs mb-1'><i class='simple-icon-note'></i></button>
                </li>
                <li class='list-inline-item'>
                <button type='button' onclick='del(" .
                        $data->id .
                        ")' class='btn btn-danger btn-xs mb-1'><i class='simple-icon-trash'></i></button>
                </li>

            </ul>";
                    return $btn;
                })
                // ->addColumn('kuantitasnya', function ($data) {
                //     $btn = $data->jumlah . ' ' . $data->satuan;
                //     return $btn;
                // })
                ->rawColumns([
                    'aksi',
                    // 'kuantitasnya',
                    // 'namanya'
                ])
                ->make(true);
        }
        return view('admin.data.costumer');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_c' => 'required|max:400',
            'email_c' => 'required|max:400',
            'hp_c' => 'required|max:400',
            'alamat_c' => 'required|max:400',
            'asal_c' => 'required|max:400',
            'no_atm_c' => 'required|max:400',
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }

        $user = User::create([
            'name' => $request->nama_c,
            'username' => $request->email_c,
            'role' => '3',
            'email' =>  $request->email_c,
            'password' =>  Hash::make('password'),
            'status' => '0'
        ]);

        $save = customer::create([
            'id_user' => $user->id,
            'nama_c' => $request->nama_c,
            'email_c' => $request->email_c,
            'hp_c' => $request->hp_c,
            'alamat_c' => $request->alamat_c,
            'debit_c' => '0',
            'kredit_c' => '0',
            'asal_c' => $request->asal_c,
            'no_atm_c' => $request->no_atm_c,

        ]);
        if ($save) {
            return 'success';
        }
    }

    public function update(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'kredit_c' => 'required|max:400',
        // ]);
        // if ($validator->fails()) {
        //     $data = ['status' => 'error', 'data' => $validator->errors()];
        //     return $data;
        // }
        $data = customer::where('id', $request->id)->first();
        // dd($request->id);


        $data->kredit_c = $request->kredit_c;
        $data->save();

        if ($data) {
            return 'success';
        }
    }
}
