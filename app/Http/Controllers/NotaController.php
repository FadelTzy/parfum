<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\Setting;
use Illuminate\Http\Request;

class NotaController extends Controller
{
    public function index()
    {
        $nota = Setting::get()->first();
        return view('admin.data.nota', compact('nota'));
    }
}
