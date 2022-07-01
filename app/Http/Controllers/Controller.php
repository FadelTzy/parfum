<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\t_dosen;
use App\Models\t_konsultasi;
use App\Models\t_mahasiswa;
use App\Models\t_message;
use Yajra\DataTables\DataTables;
use App\Models\t_relasi;
use App\Models\t_periode;
use Illuminate\Support\Facades\Storage;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index()
    {

        return view('admin.dashboard');
    }
    public function profil()
    {
        return view('admin.profil');
    }
    public function deleterekap($id)
    {
        t_konsultasi::where('id', $id)->delete();
        $mes =  t_message::where('id_konsul', $id)->get();
        foreach ($mes as $value) {
            if ($value->meta != null) {
                Storage::delete('public/file/' . $value->meta);
                $value->delete();
            } else {
                $value->delete();
            }
        }
        return 'success';
    }
    public function rm4($idp, $idr)
    {
        return Datatables::of(t_konsultasi::with('topik')->where('id_relasi', $idr)->where('id_periode', $idp)->get())->addIndexColumn()->addColumn('aksi', function ($data) {
            $dataj = json_encode($data);
            $btn = "      <ul class='list-inline mb-0'>
     
                <li class='list-inline-item'>
                <button type='button' data-toggle='modal' data-target='.rekap-modal-lg' onclick='rekap(" . $dataj . ")' class='btn btn-primary btn-xs mb-1'>Keperluan</button>
                </li>
             
                <li class='list-inline-item'>
                <button type='button' onclick='hapus(" . $data->id . ")' class='btn btn-danger btn-xs mb-1'>Hapus</button>
                </li>
            </ul>";
            return $btn;
        })->addColumn('status', function ($data) {
            if ($data->status == 0) {
                return '<span class="badge badge-primary">Baru</span>';
            } elseif ($data->status == 1) {
                return '<span class="badge badge-success">Sementara</span>';
            } else {
                return '<span class="badge badge-warning">Selesai</span>';
            }
        })->addColumn('topik', function ($data) {
            return $data->topik->nama;
        })->addColumn('created_at', function ($data) {
            return $data->created_at->format('Y-M-d');
        })->rawColumns(['aksi', 'status', 'topik', 'created_at'])->make(true);
    }
    public function rm3($id)
    {
        $isd = t_relasi::where('nim', $id)->first()->id;
        if (request()->ajax()) {
            return Datatables::of(t_konsultasi::with('topik')->where('id_relasi', $isd)->get())->addIndexColumn()->addColumn('aksi', function ($data) {
                $dataj = json_encode($data);
                $btn = "      <ul class='list-inline mb-0'>
         
                <li class='list-inline-item'>
                <button type='button' data-toggle='modal' data-target='.rekap-modal-lg' onclick='rekap(" . $dataj . ")' class='btn btn-primary btn-xs mb-1'>Keperluan</button>
                </li>
                <li class='list-inline-item'>
                <button type='button' onclick='hapus(" . $data->id . ")' class='btn btn-danger btn-xs mb-1'>Hapus</button>
                </li>
            </ul>";
                return $btn;
            })->addColumn('status', function ($data) {
                if ($data->status == 0) {
                    return '<span class="badge badge-primary">Baru</span>';
                } elseif ($data->status == 1) {
                    return '<span class="badge badge-success">Sementara</span>';
                } else {
                    return '<span class="badge badge-warning">Selesai</span>';
                }
            })->addColumn('topik', function ($data) {
                return $data->topik->nama;
            })->addColumn('created_at', function ($data) {
                return $data->created_at->format('Y-M-d');
            })->rawColumns(['aksi', 'status', 'topik', 'created_at'])->make(true);
        }
        $mhs = t_mahasiswa::where('nim', $id)->first();
        $tanggal = t_periode::all();
        return view('admin.riwayat', compact('mhs', 'isd', 'tanggal'));
    }
    public function rm2($tahun)
    {
        return Datatables::of(
            t_mahasiswa::with('relasi.konsultasi')->select('t_mahasiswas.nama', 't_mahasiswas.nim',  't_mahasiswas.prodi', 't_mahasiswas.angkatan', 't_relasis.id')
                ->leftJoin('t_relasis', 't_relasis.nim', '=', 't_mahasiswas.nim')
                ->where('t_mahasiswas.angkatan', $tahun)
                ->get()
        )->addIndexColumn()->addColumn('aksi', function ($data) {


            $btn = "      <ul class='list-inline mb-0'>
   
                    <li class='list-inline-item'>
                    <a type='button' href='" . url('admin/rekap-mahasiswa/' . $data->nim) . "'   class='btn btn-success btn-xs mb-1'><i class='simple-icon-list'></i></a>
                    </li>
               
                </ul>";
            return $btn;
        })->addColumn('total', function ($data) {
            if ($data->konsultasi->count() != 0) {
                $btn = $data->relasi->konsultasi->count();
            } else {
                $btn = 0;
            }
            return $btn;
        })->addColumn('terakhir', function ($data) {
            if ($data->relasi != null) {
                $total = $data->relasi->konsultasi->count();
                if ($total != 0) {
                    $btn = $data->relasi->konsultasi[$total - 1]->created_at;
                } else {
                    $btn = '-';
                }
            } else {
                $btn = '-';
            }
            return $btn;
        })->rawColumns(['aksi', 'total', 'terakhir'])->make(true);
    }
    public function rm()
    {
        if (request()->ajax()) {
            return Datatables::of(
                t_mahasiswa::with('relasi.konsultasi')->select('t_mahasiswas.nama', 't_mahasiswas.nim',  't_mahasiswas.prodi', 't_mahasiswas.angkatan', 't_relasis.id')
                    ->leftJoin('t_relasis', 't_relasis.nim', '=', 't_mahasiswas.nim')
                    ->get()
            )->addIndexColumn()->addColumn('aksi', function ($data) {


                $btn = "      <ul class='list-inline mb-0'>
   
                    <li class='list-inline-item'>
                    <a type='button' href='" . url('admin/rekap-mahasiswa/' . $data->nim) . "'   class='btn btn-success btn-xs mb-1'><i class='simple-icon-list'></i></a>
                    </li>
               
                </ul>";
                return $btn;
            })->addColumn('total', function ($data) {
                if ($data->konsultasi->count() != 0) {
                    $btn = $data->relasi->konsultasi->count();
                } else {
                    $btn = 0;
                }
                return $btn;
            })->addColumn('terakhir', function ($data) {
                if ($data->relasi != null) {
                    $total = $data->relasi->konsultasi->count();
                    if ($total != 0) {
                        $btn = $data->relasi->konsultasi[$total - 1]->created_at;
                    } else {
                        $btn = '-';
                    }
                } else {
                    $btn = '-';
                }

                return $btn;
            })->rawColumns(['aksi', 'total', 'terakhir'])->make(true);
        }
        $angkatan =  t_mahasiswa::select('angkatan')->distinct()->get();
        $total = t_konsultasi::count();
        return view('admin.rekapmahasiswa', compact('angkatan', 'total'));
    }
    public function rd()
    {
        # code...
    }
}
