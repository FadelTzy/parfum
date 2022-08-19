<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use Yajra\DataTables\DataTables;
use App\Models\Basket;
use Akaunting\Money\Money;
use App\Models\customer;
use App\Models\Setting;
use App\Models\Transaksi;
use App\Models\riwayatPembelian;

class TransaksiController extends Controller
{
    public function check()
    {
        $data = Basket::get();
        return response()->json($data);
    }
    public function delete($id)
    {
        $data = Transaksi::where('id', $id)->first();
        riwayatPembelian::where('id_transak', $id)->delete();
        $data->delete();
        return 'success';
    }
    public function bayar(Request $request)
    {
        
        try {
            $checking = Transaksi::where('id', $request->id)->first();
            $checking->jumlah = $request->jumlah;
            $checking->totalharga = $request->harga;
            $checking->hargadiskon = $request->diskon;
            $checking->hargasetelahdiskon = $request->totalharga;
            $checking->status = 1;
            $checking->jenistransfer = $request->metode;
            $checking->tanggalbayar = date('d - m - Y');
            $checking->updated_at = date('Y-m-d G:i:s');

            $checking->save();
            if ($checking) {
                $c = customer::where('id',$checking->id_user)->first();
                $sisa = ((int)$c->kredit_c - (int)$request->totalharga);
                if($sisa < 0){
                    $abss = abs($sisa);
                    $c->debit_c = $c->debit_c + $abss;
                    $c->kredit_c = 0;

                }else{
                    $c->kredit_c = $sisa;
                    $c->debit_c = 0;
                }
                $c->save();
                return 'success';
            }
        } catch (\Throwable $th) {
            return 'error';
        }
    }
    public function simpan(Request $request)
    {
        try {
            $checking = Transaksi::where('id', $request->id)->first();
            $checking->jumlah = $request->total;
            $checking->totalharga = $request->harga;
            $checking->hargadiskon = $request->diskon;
            $checking->hargasetelahdiskon = $request->totalharga;
            $checking->id_user = $request->idpelanggan ?? null;

            $checking->save();
            if ($checking) {
                return 'success';
            }
        } catch (\Throwable $th) {
            return 'error';
        }
    }
    public function basketeditharga(Request $request)
    {
        try {
            $checking = riwayatPembelian::where('id', $request->id)->first();
            $checking->harga = $request->harga;
            $checking->save();
            if ($checking) {
                return 'success';
            }
        } catch (\Throwable $th) {
            return 'error';
        }
    }
    public function basketeditdiskon(Request $request)
    {
        try {
            $checking = riwayatPembelian::where('id', $request->id)->first();
            $checking->diskon = $request->diskon;
            $checking->save();
            if ($checking) {
                return 'success';
            }
        } catch (\Throwable $th) {
            return 'error';
        }
    }
    public function cart($id)
    {
        $sT = Setting::first();
        $dT = Transaksi::with('oCustomer')->where('id', $id)->first();
        $rP = riwayatPembelian::where('id_transak', $id)->get();
        if (request()->ajax()) {
            return Datatables::of(riwayatPembelian::where('id_transak', $id)->get())
                ->addIndexColumn()
                ->addColumn('namanya', function ($data) {
                    $btn =
                        '<div class="media d-flex align-items-center">
               <img src="' .
                        url('image/produk') .
                        '/' .
                        ($data->gambar ?? 'none.jpg') .
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
                <button type='button' onclick='upd(" .
                        $dataj .
                        ")'  class='btn btn-primary mb-1'><i class='simple-icon-plus'></i></button>
                </li>


            </ul>";
                    return $btn;
                })
                ->addColumn('btnsatuan', function ($data) {
                    $dataj = json_encode($data);

                    $btn =
                        "      <ul class='list-inline mb-0'>
                <li class='list-inline-item'>
                <button type='button' onclick='hapus(" .
                        $data->id .
                        ',' .
                        $data->jumlah .
                        ")'  class='btn btn-xs btn-danger mb-1'><b>-</b></button>
                </li>
                <li class='list-inline-item'>
                " .
                        $data->jumlah .
                        "
                    </li>
                <li class='list-inline-item'>
                <button type='button' onclick='tambah(" .
                        $data->id .
                        ',' .
                        $data->jumlah .
                        ")'  class='btn btn-xs btn-primary mb-1'><b>+</b></button>
                </li>

            </ul>";
                    return $btn;
                })
                ->addColumn('dsc', function ($data) {
                    $dataj = json_encode($data);
                    if ($data->diskon) {
                        # code...
                        $btn = "<a href='#' onclick='changeDiskon(" . $dataj . ")'>" . $data->diskon . '</a>';
                    } else {
                        $btn = "<a href='#' onclick='changeDiskon(" . $dataj . ")'>" . '...' . '</a>';
                    }
                    return $btn;
                })
                ->addColumn('do', function ($data) {
                    $dataj = json_encode($data);
                    if ($data->tipe == 'parfum') {
                        # code...
                        $btn = "<a href='#' onclick='changeD(" . $dataj . ")'>" . Money::USD($data->harga, true) . '</a>';
                    } else {
                        $btn = '';
                    }
                    return $btn;
                })
                ->addColumn('dt', function ($data) {
                    if ($data->tipe == 'parfum') {
                        # code...
                        $btn = Money::USD((int)$data->harga * (int)$data->jumlah, true);
                    } else {
                        $btn = '';
                    }
                    return $btn;
                })
                ->addColumn('ro', function ($data) use ($sT) {
                    $dataj = json_encode($data);
                    if ($data->tipe == 'parfum') {
                        # code...
                        
                        $btn = Money::IDR((int)$data->harga * (int)$sT->kurs, true);
                    } else {
                        $btn = "<a href='#' onclick='changeD(" . $dataj . ")'>" . Money::IDR($data->harga, true) . '</a>';
                    }
                    return $btn;
                })
                ->addColumn('rt', function ($data) use ($sT) {
                    if ($data->tipe == 'parfum') {
                        # code...
                        $har = (int)$data->harga * (int)$data->jumlah * (int)$sT->kurs;
                        $btn = Money::IDR((int)$data->harga * (int)$sT->kurs * (int)$data->jumlah, true);
                    } else {
                        $har = (int)$data->harga * (int)$data->jumlah;
                        $btn = Money::IDR((int)$data->harga * (int)$data->jumlah, true);
                    }
                    return $btn . "<input name='totha[]' class='cicas' type='hidden' value='" . $har . "'/>";
                })
                ->addColumn('totals', function ($data) use ($sT) {
                    if ($data->tipe == 'parfum') {
                        # code...
                        $har = (int)$data->harga * (int)$data->jumlah * (int)$sT->kurs;
                    } else {
                        $har = (int)$data->harga * (int)$data->jumlah;
                    }
                    return $har;
                })
                ->addColumn('diskonnya', function ($data) use ($sT) {
                    if ($data->diskon) {
                        # code...
                        if ($data->tipe == 'parfum') {
                            # code...
                            $har = (int)$data->harga * (int)$data->jumlah * (int)$sT->kurs * ((int)$data->diskon * 0.01);
                        } else {
                            $har = (int)$data->harga * (int)$data->jumlah * ((int)$data->diskon * 0.01);
                        }
                    } else {
                        $har = 0;
                    }
                    return $har;
                })
                ->rawColumns(['aksi', 'diskonnya', 'do', 'dt', 'ro', 'dsc', 'totals', 'btnsatuan', 'rt', 'kuantitasnya', 'namanya'])
                ->make(true);
        }
        $date = Date('d - m - Y');

        return view('admin.transaksi.cart', compact('dT', 'rP', 'sT', 'date'));
    }
    public function basket(Request $request)
    {
        try {
            $save = Transaksi::create([
                'id_user' => null,
                'tanggalpesan' => date('d - m - Y'),
                'tipe' => null,
                'status' => 2,
                'nopemesanan' => date('dmYHi'),
            ]);
            foreach ($request->id_barang as $key => $value) {
                riwayatPembelian::create([
                    'id_user' => null,
                    'id_transak' => $save->id,
                    'id_barang' => $value,
                    'namabarang' => $request->nama[$key],
                    'kodebarang' => $request->kode[$key],
                    'gambar' => $request->gambar[$key],
                    'tipe' => $request->tipe[$key],
                    'harga' => $request->harga[$key],
                    'diskon' => $request->diskon[$key],
                    'jumlah' => $request->satuan[$key],
                    'satuan' => $request->cc[$key],
                ]);
            }
            Basket::truncate();
            return $save->id;
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function basketremove(Request $request)
    {
        try {
            $checking = Basket::where('id_barang', $request->id)->first();
            if ($request->status == 1) {
                $checking->jumlah = 1 + $checking->jumlah;
            } else {
                $data = $checking->jumlah - 1;
                $checking->jumlah = $data;
                if ($data == 0) {
                    $checking->delete();
                    return 'success';
                }
            }
            $checking->save();
            if ($checking) {
                return 'success';
            }
        } catch (\Throwable $th) {
            return 'error';
        }
    }
    public function basketremove2(Request $request)
    {
        try {
            $checking = riwayatPembelian::where('id', $request->id)->first();
            if ($request->status == 1) {
                $checking->jumlah = 1 + $checking->jumlah;
            } else {
                $data = $checking->jumlah - 1;
                $checking->jumlah = $data;
                if ($data == 0) {
                    $checking->delete();
                    return 'success';
                }
            }
            $checking->save();
            if ($checking) {
                return 'success';
            }
        } catch (\Throwable $th) {
            return 'error';
        }
    }
    public function basketsave(Request $request)
    {
        try {
            $checking = Basket::where('id_barang', $request->id)->first();
            if ($checking) {
                $checking->jumlah = 1 + $checking->jumlah;
                $checking->save();
                return 'success';
            } else {
                $save = Basket::create([
                    'id_barang' => $request->id,
                    'namabarang' => $request->nama,
                    'kodebarang' => $request->kode,
                    'gambar' => $request->gambar,
                    'harga' => $request->harga,
                    'hargaS' => $request->harga,
                    'tipe' => $request->jenis,
                    'satuan' => $request->satuan,

                    'jumlah' => 1,
                    'diskon' => 0,
                ]);
                if ($save) {
                    return 'success';
                }
            }
        } catch (\Throwable $th) {
            return $th;
        }
    }
    public function index()
    {
        $dB = Basket::all();
        if (request()->ajax()) {
            return Datatables::of(Barang::get())
                ->addIndexColumn()
                ->addColumn('namanya', function ($data) {
                    $btn =
                        '<div class="media d-flex align-items-center">
               <img src="' .
                        url('image/produk') .
                        '/' .
                        ($data->gambar == null ? 'none.png' : $data->gambar) .
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
                <button type='button' onclick='upd(" .
                        $dataj .
                        ")'  class='btn btn-primary mb-1'><i class='simple-icon-plus'></i></button>
                </li>


            </ul>";
                    return $btn;
                })
                ->addColumn('kuantitasnya', function ($data) {
                    $btn = $data->jumlah . ' ' . $data->satuan;
                    return $btn;
                })
                ->addColumn('harganya', function ($data) {
                    if ($data->jenis == 'parfum') {
                        $btn = Money::USD($data->harga, true) . ' / ' . $data->satuan;
                    }else{

                        $btn = Money::IDR($data->harga, true) . ' / ' . $data->satuan;
                    }
                    return $btn;
                })
                ->rawColumns(['aksi', 'harganya', 'kuantitasnya', 'namanya'])
                ->make(true);
        }
        return view('admin.transaksi.baru', compact('dB'));
    }
    public function riwayat()
    {
        $dB = Basket::all();
        if (request()->ajax()) {
            return Datatables::of(Transaksi::get())
                ->addIndexColumn()
                ->addColumn('namanya', function ($data) {
                    $btn =
                        '<div class="media d-flex align-items-center">
               <img src="' .
                        url('image/produk') .
                        '/' .
                        ($data->gambar ?? 'none.jpg') .
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

                    $btn = "      <ul class='list-inline mb-0'>";

                    $btn .=
                        "<li class='list-inline-item'>
                <a href='" .
                        url('admin/cart/') .
                        '/' .
                        $data->id .
                        "' target='_blank'  class='btn btn-sm btn-primary mb-1'><i class='simple-icon-basket'></i></a>
                </li><li class='list-inline-item'>
                <button type='button' onclick='del(" . $data->id . ")' class='btn btn-sm btn-danger mb-1'><i class='simple-icon-trash'></i></button>
                </li>";
                    if ($data->status == 1) {
                        $btn .=
                            "<li class='list-inline-item'>
                        <a class='btn btn-sm btn-warning mb-1' href='cetak/nota/" . $data->id . "'><i class='simple-icon-printer' '></i></a>
                        </li>";
                    }
                    $btn .= '</ul>';
                    return $btn;
                })
                ->addColumn('namanya', function ($data) {
                    if ($data->oCustomer) {
                        $btn = $data->oCustomer->nama_c;
                    } else {
                        $btn = 'Guest';
                    }

                    return $btn;
                })
                ->addColumn('tanggalnya', function ($data) {
                    $btn = $data->tanggalpesan;
                    return $btn;
                })
                ->addColumn('usernya', function ($data) {
                    if ($data->id_user) {
                        $btn = 'Pelanggan';
                    } else {
                        $btn = 'Guest';
                    }

                    return $btn;
                })
                ->addColumn('statusnya', function ($data) {
                    if ($data->status == 2) {
                        $btn = 'Belum Lunas';
                    } else {
                        $btn = 'Lunas';
                    }

                    return $btn;
                })
                ->addColumn('harganya', function ($data) {
                    if ($data->hargasetelahdiskon) {
                        $btn = Money::IDR($data->hargasetelahdiskon, true);
                    } else {
                        $btn = Money::IDR(0, true);
                    }

                    return $btn;
                })
                ->rawColumns(['aksi', 'namanya','harganya', 'tanggalnya', 'usernya', 'statusnya'])
                ->make(true);
        }
        $date = Date('d - m - Y');
        return view('admin.transaksi.riwayat', compact('dB', 'date'));
    }
    public function riwayat2($id)
    {
        $dC = customer::where('id',$id)->first();
        $dB = Basket::all();
        if (request()->ajax()) {
            return Datatables::of(Transaksi::where('id_user',$id)->get())
                ->addIndexColumn()
                ->addColumn('namanya', function ($data) {
                    $btn =
                        '<div class="media d-flex align-items-center">
               <img src="' .
                        url('image/produk') .
                        '/' .
                        ($data->gambar ?? 'none.jpg') .
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

                    $btn = "      <ul class='list-inline mb-0'>";

                    $btn .=
                        "<li class='list-inline-item'>
                <a href='" .
                        url('admin/cart/') .
                        '/' .
                        $data->id .
                        "' target='_blank'  class='btn btn-sm btn-primary mb-1'><i class='simple-icon-basket'></i></a>
                </li><li class='list-inline-item'>
                <button type='button' onclick='del(" . $data->id . ")' class='btn btn-sm btn-danger mb-1'><i class='simple-icon-trash'></i></button>
                </li>";
                    if ($data->status == 1) {
                        $btn .=
                            "<li class='list-inline-item'>
                        <a class='btn btn-sm btn-warning mb-1' href='cetak/nota/" . $data->id . "'><i class='simple-icon-printer' '></i></a>
                        </li>";
                    }
                    $btn .= '</ul>';
                    return $btn;
                })
                ->addColumn('tanggalnya', function ($data) {
                    $btn = $data->tanggalpesan;
                    return $btn;
                })
                ->addColumn('usernya', function ($data) {
                    if ($data->id_user) {
                        $btn = 'Pelanggan';
                    } else {
                        $btn = 'Guest';
                    }

                    return $btn;
                })
                ->addColumn('statusnya', function ($data) {
                    if ($data->status == 2) {
                        $btn = 'Belum Lunas';
                    } else {
                        $btn = 'Lunas';
                    }

                    return $btn;
                })
                ->addColumn('harganya', function ($data) {
                    if ($data->hargasetelahdiskon) {
                        $btn = Money::IDR($data->hargasetelahdiskon, true);
                    } else {
                        $btn = Money::IDR(0, true);
                    }

                    return $btn;
                })
                ->addColumn('namanya', function ($data) {
                    if ($data->oCustomer) {
                        $btn = $data->oCustomer->nama_c;
                    } else {
                        $btn = 'Guest';
                    }

                    return $btn;
                })
                ->rawColumns(['aksi', 'harganya', 'tanggalnya', 'usernya', 'statusnya'])
                ->make(true);
        }
        $date = Date('d - m - Y');
        return view('admin.transaksi.riwayatc', compact('dB', 'date','dC'));
    }
}
