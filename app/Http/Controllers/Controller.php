<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\t_dosen;
use App\Models\t_konsultasi;
use App\Models\t_mahasiswa;
use Yajra\DataTables\DataTables;

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
 
   

   
   
    public function rd()
    {
        # code...
    }
}
