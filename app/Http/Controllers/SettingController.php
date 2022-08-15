<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;

class SettingController extends Controller
{
    public function index()
    {
        $setting = Setting::get()->first();
        return view('admin.data.setting', compact('setting'));
    }

    public function update(Request $request)
    {
        $nama_file = null;
        $excel = null;
        if (request()->file('logo')) {
            $gmbr = request()->file('logo');

            $nama_file = str_replace(' ', '_', time() . '_' . $gmbr->getClientOriginalName());
            $tujuan_upload = 'image/logoapp/';
            $gmbr->move($tujuan_upload, $nama_file);
        }
        if (request()->file('excel')) {
            $gmbr = request()->file('excel');

            $excel = str_replace(' ', '_', time() . '_' . $gmbr->getClientOriginalName());
            $tujuan_upload = 'file/';
            $gmbr->move($tujuan_upload, $excel);
        }
        $save =  Setting::where('id', 1)->first();
      $save->nama_app=  $request->nama_app;
      $save->alamat=  $request->alamat;
      $save->notelp=  $request->notelp;
      $save->kurs=  $request->kurs;
      $save->kecamatan=  $request->kecamatan;
      $save->atm=  $request->atm;
      $save->logo= $nama_file ?? $save->logo;
      $save->exportfile= $excel ?? $save->exportfile;
      $save->save();
        if ($save) {
            return 'success';
        }
    }
}
