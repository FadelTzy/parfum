<?php

namespace App\Http\Controllers;

use Akaunting\Money\Money;
use App\Exports\barangExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Barang;
use Yajra\DataTables\DataTables;
use App\Imports\barangImport;

use Maatwebsite\Excel\Facades\Excel;
class BarangController extends Controller
{
    public function import(Request $request)
    {
       
        $validator = Validator::make($request->all(), [
            'excel' => 'required|mimes:csv,xls,xlsx'
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        Excel::import(new barangImport(), request()->file('excel'));
    }
    public function export(Request $request)
    {
       
        return Excel::download(new barangExport(), 'daftarbarang.xlsx');

    }
    public function destroy($id)
    {
        $data = Barang::where('id',$id)->first();
        if ($data->gambar) {
            $path = '/image/produk/' . $data->gambar;
            if (file_exists(public_path() . $path)) {
                unlink(public_path() . $path);
            }
        }
        $data->delete();
        return 'success';
    }
    public function barang()
    {
        if (request()->ajax()) {
            return Datatables::of(Barang::get())
                ->addIndexColumn()
                ->addColumn('namanya', function ($data) {
                    $btn =
                        '<div class="media d-flex align-items-center">
               <img src="' .
                        url('image/produk') .
                        '/' .
                        ($data->gambar != null ? $data->gambar:'none.png') .
                        '" width="40%" alt="table-user" class="mr-3 rounded-circle avatar-sm">
               <div class="">
                   <h6 class=""><a href="javascript:void(0);" class="text-dark">' .
                        $data->nama .
                        '</a></h6>
               </div>
           </div>';
                    return $btn;
                })
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
                ->addColumn('kuantitasnya', function ($data) {
                    $btn = $data->jumlah . ' ' . $data->satuan;
                    return $btn;
                })
                ->addColumn('harganya', function ($data) {
                    $btn =  Money::IDR($data->harga, true);

                    return $btn;
                })
                ->rawColumns(['aksi', 'kuantitasnya', 'namanya'])
                ->make(true);
        }
        return view('admin.data.barang');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required|max:400',
            'nama' => 'required|max:400',
            'merek' => 'required|max:400',
            'kuantitas' => 'required|max:400',
            'satuan' => 'required|max:400',
            'harga' => 'required|max:400',
            'gambar' => 'mimes:jpeg,png,jpg|max:400',
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        if (request()->file('gambar')) {
            $gmbr = request()->file('gambar');

            $nama_file = str_replace(' ', '_', time() . '_' . $gmbr->getClientOriginalName());
            $tujuan_upload = 'image/produk/';
            $gmbr->move($tujuan_upload, $nama_file);
        }
        $save = Barang::create([
            'kode' => $request->kode,
            'merek' => $request->merek,
            'nama' => $request->nama,
            'jumlah' => $request->kuantitas,
            'satuan' => $request->satuan,
            'harga' => $request->harga,
            'jenis' => $request->jenisproduk,

            'gambar' => $nama_file ?? null,
        ]);
        if ($save) {
            return 'success';
        }
    }
    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'kode' => 'required|max:400',
            'nama' => 'required|max:400',
            'merek' => 'required|max:400',
            'kuantitas' => 'required|max:400',
            'satuan' => 'required|max:400',
            'harga' => 'required|max:400',
            'gambar' => 'mimes:jpeg,png,jpg|max:400',
        ]);
        if ($validator->fails()) {
            $data = ['status' => 'error', 'data' => $validator->errors()];
            return $data;
        }
        $data = Barang::where('id', $request->id)->first();
        if (request()->file('gambar')) {
            $gmbr = request()->file('gambar');
            if ($data->gambar) {
                $path = 'image/produk/' . $data->gambar;
                if (file_exists(public_path() . $path)) {
                    unlink(public_path() . $path);
                }
            }
            $nama_file = str_replace(' ', '_', time() . '_' . $gmbr->getClientOriginalName());
            $tujuan_upload = 'image/produk/';
            $gmbr->move($tujuan_upload, $nama_file);

            $data->gambar = $nama_file;
        }

        $data->kode = $request->kode;
        $data->merek = $request->merek;
        $data->nama = $request->nama;
        $data->jumlah = $request->kuantitas;
        $data->satuan = $request->satuan;
        $data->harga = $request->harga;
        $data->jenis = $request->jenisproduk;
        $data->save();

        if ($data) {
            return 'success';
        }
    }
}
