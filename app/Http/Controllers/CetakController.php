<?php

namespace App\Http\Controllers;

use App\Models\riwayatPembelian;
use App\Models\Setting;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class CetakController extends Controller
{
    public function nota($id)
    {
        $setting = Setting::get()->first();
        $barang =  riwayatPembelian::where('id_transak', $id)->get();
        $transaksi = Transaksi::where('id', $id)->get()->first();

        $no = 1;
        $settings = [
            'nama_app' => $setting->nama_app,
            'alamat' => $setting->alamat,
            'notelp' => $setting->notelp,
            'kurs' => $setting->kurs,
            'kecamatan' => $setting->kecamatan,
            'atm' => $setting->atm,
            'logo' => $setting->logo,
            'no' => $no,
            'barang' => $barang,
            'transaksi' => $transaksi,
        ];
        $pdf = PDF::loadview('admin.testing', $settings)->setPaper('a4', 'landscape');
        return $pdf->stream();
    }
}
