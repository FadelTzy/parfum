<?php

namespace App\Http\Controllers;

use App\Models\t_periode;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Validator;

class TPeriodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return Datatables::of(t_periode::all())->addIndexColumn()->addColumn('aksi', function ($data) {

                $btn = "      <ul class='list-inline mb-0'>
                <li class='list-inline-item'>
                <button type='button' data-toggle='modal' onclick='upd(" . $data->id . ")' title='aktifkan periode' data-backdrop='static' data-target='#exampleModalRightu' class='btn btn-success btn-xs mb-1'><i class='simple-icon-check'></i></button>
                </li>
                <li class='list-inline-item'>
                <button type='button' onclick='del(" . $data->id . ")' class='btn btn-danger btn-xs mb-1'><i class='simple-icon-trash'></i></button>
                </li>
           
            </ul>";
                return $btn;
            })->addColumn('status', function ($data) {
                if ($data->aktif == 1) {
                    return '<span class="badge badge-primary">Aktif</span>';
                } else {
                    return '<span class="badge badge-warning">Non</span>';
                }
            })->rawColumns(['aksi', 'status'])->make(true);
        }
        return view('admin.data.periode');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $year = request()->input('awal');
        $ts1 = $year;
        $ts2 = $year + 1;
        $ta = $ts1 . '-' . $ts2;
        $bs1 = 'Juli - Desember ' . $ts1;
        $bs2 = 'Januari - Juni ' . $ts2;

        $saved = t_periode::updateOrCreate(
            [
                'tahun_ajaran' => $ta,
                'semester' => 1,
            ],
            [
                'nama_periode' => $bs1,
                'aktif' => 0
            ]
        );
        $saved = t_periode::updateOrCreate(
            [
                'tahun_ajaran' => $ta,
                'semester' => 2,
            ],
            [
                'nama_periode' => $bs2,
                'aktif' => 0
            ]
        );
        return 'success';
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\t_periode  $t_periode
     * @return \Illuminate\Http\Response
     */
    public function show(t_periode $t_periode)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\t_periode  $t_periode
     * @return \Illuminate\Http\Response
     */
    public function edit(t_periode $t_periode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\t_periode  $t_periode
     * @return \Illuminate\Http\Response
     */
    public function update()
    {
        $id = request()->input('id');
        t_periode::where('aktif', '1')->update(['aktif' => '0']);

        $data = t_periode::where('id', $id)->update(['aktif' => '1']);
        if ($data) {
            return 'success';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\t_periode  $t_periode
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = t_periode::where('id', $id)->first();
        $res = t_periode::where('tahun_ajaran', $data->tahun_ajaran)->delete();
        if ($res) {
            return "success";
        }
    }
}
