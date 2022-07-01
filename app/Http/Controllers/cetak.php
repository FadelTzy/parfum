<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\t_relasi;
use App\Models\t_konsultasi;
use App\Models\t_mahasiswa;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use App\Models\t_periode;
use Illuminate\Support\Carbon;
use App\Models\prestasi;

class cetak extends Controller
{
    public function mhssks()
    {
        $data['sks'] = Datatables::of(prestasi::where('nim', Auth::user()->username)->get())->addIndexColumn()->rawColumns([])->make(true);
        $data['tanggal'] = Carbon::parse(date('Y-m-d'))->translatedFormat('d F Y');
        $data['mhs'] = t_mahasiswa::where('nim', Auth::user()->username)->first();
        $periode = t_periode::where('aktif', '1')->first();
        $tahunaktif = explode('-', $periode->tahun_ajaran);
        if ($periode->semester == 1) {
            $data['smsaktif'] = ($tahunaktif[0] -  $data['mhs']->angkatan) * 2 + 1;
        } else {
            $data['smsaktif'] = ($tahunaktif[0] -  $data['mhs']->angkatan) * 2 + 2;
        }
        $pdf = \PDF::loadView('pdf.konsulsks', $data);
        return $pdf->setPaper('a4', 'landscape')->download('laporan-prestasi-akademik' . Auth::user()->username . '.pdf');
    }
    public function mhsrekap()
    {
        $id_rel = t_relasi::where('nim', Auth::user()->username)->first()->id;
        $data['mhs'] = t_mahasiswa::where('nim', Auth::user()->username)->first();
        $angkatan = $data['mhs']->angkatan;
        if (request()->input('periode') == 0) {
            $data['konsul'] = Datatables::of(t_konsultasi::with('topik')->select('t_konsultasis.*', 't_periodes.tahun_ajaran', 't_periodes.semester')->join('t_periodes', 't_periodes.id', '=', 't_konsultasis.id_periode')->where('t_konsultasis.id_relasi', $id_rel)->get())->addIndexColumn()->addColumn('status', function ($data) {
                if ($data->status == 0) {
                    return '<span class="badge badge-danger">Baru</span>';
                } elseif ($data->status == 1) {
                    return '<span class="badge badge-success">Sementara</span>';
                } else {
                    return '<span class="badge badge-warning">Selesai</span>';
                }
            })->addColumn('topik', function ($data) {
                return $data->topik->nama;
            })->addColumn('created_at', function ($data) {
                return  Carbon::parse($data->created_at)->translatedFormat('d F Y');
            })->addColumn('semester', function ($data) use ($angkatan) {
                $tahunaktif = explode('-', $data->tahun_ajaran);

                if ($data->semester == 1) {
                    $smsaktif = ($tahunaktif[0] - $angkatan) * 2 + 1;
                } else {
                    $smsaktif = ($tahunaktif[0] - $angkatan) * 2 + 2;
                }
                return $smsaktif;
            })->rawColumns(['status', 'semester', 'topik', 'created_at'])->make(true);
        } else {

            $data['konsul'] = Datatables::of(t_konsultasi::with('topik')->select('t_konsultasis.*', 't_periodes.tahun_ajaran', 't_periodes.semester')->join('t_periodes', 't_periodes.id', '=', 't_konsultasis.id_periode')->where('t_konsultasis.id_relasi', $id_rel)->where('t_konsultasis.id_periode', request()->input('periode'))->get())->addIndexColumn()->addColumn('status', function ($data) {
                if ($data->status == 0) {
                    return '<span class="badge badge-danger">Baru</span>';
                } elseif ($data->status == 1) {
                    return '<span class="badge badge-success">Sementara</span>';
                } else {
                    return '<span class="badge badge-warning">Selesai</span>';
                }
            })->addColumn('topik', function ($data) {
                return $data->topik->nama;
            })->addColumn('created_at', function ($data) {
                return  Carbon::parse($data->created_at)->translatedFormat('d F Y');
            })->addColumn('semester', function ($data) use ($angkatan) {
                $tahunaktif = explode('-', $data->tahun_ajaran);

                if ($data->semester == 1) {
                    $smsaktif = ($tahunaktif[0] - $angkatan) * 2 + 1;
                } else {
                    $smsaktif = ($tahunaktif[0] - $angkatan) * 2 + 2;
                }
                return $smsaktif;
            })->rawColumns(['status', 'semester', 'topik', 'created_at'])->make(true);
        }

        $data['tanggal'] = Carbon::parse(date('Y-m-d'))->translatedFormat('d F Y');

        $pdf = \PDF::loadView('pdf.konsulmhs', $data);
        return $pdf->setPaper('a4', 'landscape')->download('konsultasi-mahasiswa' . '.pdf');
    }
}
