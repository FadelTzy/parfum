<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Yajra\DataTables\DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Transaksi;
use Akaunting\Money\Money;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function index()
    {
        $data = Transaksi::where('updated_at', '>=', Carbon::today())
        ->get()
        ->sum('totalharga');
        $duit = Money::IDR($data, true);
        $today = Date("Y/m/d");
        return view('admin.dashboard',compact('duit','today'));
    }
    public function profil()
    {
        return view('admin.profil');
    }
    public function getduit(Request $request)
    {
        if ($request->tipe == 1) {
            $data = Transaksi::where('updated_at', '>=', Carbon::today())
                ->get()
                ->sum('totalharga');
                $dates = Date("Y/m/d");
      
        }
        if ($request->tipe == 2) {
            $now = Carbon::now();
            $weekStartDate = $now->startOfWeek()->format('Y-m-d H:i');
            $weekEndDate = $now->endOfWeek()->format('Y-m-d H:i');
            $weekstart = $now->startOfWeek()->format('Y/m/d');
            $weekend = $now->endOfWeek()->format('Y/m/d');
            $dates = $weekstart . ' - ' . $weekend;
            $data = Transaksi::where('status', 1)
                ->where('updated_at', '>=', $weekStartDate)
                ->where('updated_at', '<=', $weekEndDate)
                ->get()
                ->sum('totalharga');
       
        }
        if ($request->tipe == 3) {
            $now = Carbon::now();
            $MonthStartDate = $now->startOfMonth()->format('Y-m-d H:i');
            $MonthEndDate = $now->endOfMonth()->format('Y-m-d H:i');
            $monthstart = $now->startOfMonth()->format('Y/m/d');
            $monthend = $now->endOfMonth()->format('Y/m/d');
            $dates = $monthstart . ' - ' . $monthend;
            $data = Transaksi::where('status', 1)
                ->where('updated_at', '>=', $MonthStartDate)
                ->where('updated_at', '<=', $MonthEndDate)
                ->get()
                ->sum('totalharga');
          
        }
        if ($request->tipe == 4) {
            $now = Carbon::now();
            $YearStartDate = $now->startOfYear()->format('Y-m-d H:i');
            $YearEndDate = $now->endOfYear()->format('Y-m-d H:i');
            $Yearstart = $now->startOfYear()->format('Y/m/d');
            $Yearend = $now->endOfYear()->format('Y/m/d');
            $dates = $Yearstart . ' - ' . $Yearend;
            $data = Transaksi::where('status', 1)
                ->where('updated_at', '>=', $YearStartDate)
                ->where('updated_at', '<=', $YearEndDate)
                ->get()
                ->sum('totalharga');
          
        }
        $uang = $data;
        //   return $uang;
       
       return response()
            ->json(['dates'=>$dates,  'duit' => 'Rp . ' . number_format($uang, 2)]);

    }

    public function rd()
    {
        # code...
    }
}
