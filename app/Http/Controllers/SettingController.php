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
        if (request()->file('logo')) {
            $gmbr = request()->file('logo');

            $nama_file = str_replace(' ', '_', time() . '_' . $gmbr->getClientOriginalName());
            $tujuan_upload = 'image/logoapp/';
            $gmbr->move($tujuan_upload, $nama_file);
        }
        $save =  Setting::where('id', 1)
            ->update(
                [
                    'nama_app' =>  $request->nama_app,
                    'alamat' =>  $request->alamat,
                    'notelp' =>  $request->notelp,
                    'kurs' =>  $request->kurs,
                    'kecamatan' =>  $request->kecamatan,
                    'atm' =>  $request->atm,
                    'logo' => $nama_file  ?? null,
                ]
            );
        if ($save) {
            return 'success';
        }
    }
}
