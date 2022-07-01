@extends('admin.index')

@section('pagecss')
<link rel="stylesheet" href="{{asset('asset/css/vendor/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('asset/css/vendor/bootstrap-datepicker.min.css')}}">

<link rel="stylesheet" href="{{asset('asset/css/vendor/datatables.responsive.bootstrap4.min.css')}}">

@endsection


@section('contentpage')
<div class="row">
    <div class="col-12">
        <h1>Tabel Data Periode </h1>
        <div class="top-right-button-container"><button type="button" class="btn btn-primary btn top-right-button mr-1" data-toggle="modal" data-backdrop="static" data-target="#exampleModalRight"> <i class="simple-icon-magnifier-add"></i> <b> Tambah Periode</b></button>
        </div>
        <div class="modal fade modal-right" id="exampleModalRight" tabindex="-1" role="dialog" aria-labelledby="exampleModalRight" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Periode Baru</h5><button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <form id="adddata">
                            @csrf
                            <div class="form-group"><label>Awal Tahun</label>
                                <div class="input-group">
                                    <input id="awal" required autocomplete="off" name="awal" class="form-control" data-provide="datepicker" placeholder="Year" data-date-format="dd-m-yyyy">
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="simple-icon-calendar"></i></span>
                                    </div>
                                </div>
                            </div>


                        </form>
                    </div>
                    <div class="modal-footer"><button type="button" class="btn btn-outline-primary" data-dismiss="modal">Cancel</button> <button type="button" id="submitadd" class="btn btn-primary">Submit</button></div>
                </div>
            </div>
        </div>

        <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
            <ol class="breadcrumb pt-0">
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                <li class="breadcrumb-item active" aria-current="page">Periode</li>
            </ol>
        </nav>
        <div class="separator mb-5"></div>
    </div>
</div>
<div class="alert alert-danger d-none" id="notif" role="alert">
    <div id="listnotif">

    </div>
</div>

<div id="suksesnotif"></div>

<div id="suksesnotifu"></div>
<div id="suksesnotifd"></div>

<div class="row mb-4">
    <div class="col-12 mb-4">
        <div class="card">
            <div class="card-body">
                <table id="productss" class="">
                    <thead>
                        <tr>
                            <th>No</th>

                            <th>Periode</th>
                            <th>Tahun Ajaran</th>
                            <th>Semester</th>
                            <th>Status</th>

                            <th>Aksi</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('pagejs')
<script src="{{asset('asset/js/vendor/datatables.min.js')}}"></script>
<script src="{{asset('asset/js/vendor/bootstrap-datepicker.min.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js
"></script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    url = window.location.origin;
    $('#awal').datepicker({
        format: "yyyy",
        viewMode: "years",
        minViewMode: "years"
    });

    function upd(id) {
        data = confirm("Klik Ok Untuk Mengaktifkan");

        if (data) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.LoadingOverlay("show");

            $.ajax({
                url: '{{route("data.periodeedit")}}',
                type: "put",
                data: {
                    id: id
                },
                success: function(e) {
                    console.log(e);
                    $.LoadingOverlay("hide");
                    if (e == 'success') {
                        tabel.ajax.reload();
                        $('#suksesnotifd').html('<div class="alert alert-success alert-dismissible rounded " role="alert">    <strong>Berhasil Menghapus Data</strong>    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    }
                }
            })

        }


    }
    $("#submitadd").on('click', function() {
        $("#adddata").trigger('submit');
    });
    $("#submitaddu").on('click', function() {
        $("#adddatau").trigger('submit');
    });
    $("#adddata").on('submit', function(id) {
        id.preventDefault();
        var data = $(this).serialize();
        $.LoadingOverlay("show");


        $.ajax({
            url: '{{route("data.periodesave")}}',
            data: data,
            type: "POST",
            success: function(id) {
                console.log(id);
                $.LoadingOverlay("hide");

                if (id.status == 'error') {
                    var data = id.data;
                    var elem;
                    var result = Object.keys(data).map((key) => [data[key]]);
                    elem = '<div class="alert alert-danger alert-dismissible fade show pt-3" role="alert">';
                    elem += '   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span> </button><ul>';
                    result.forEach(function(data) {
                        elem += '<li>' + data[0][0] + '</li>';
                    });
                    elem += '</ul></div>';
                    $("#notif").removeClass('d-none');
                    $("#listnotif").html(elem);
                } else {
                    $('#exampleModalRight').modal('hide');
                    $('#suksesnotif').html('<div class="alert alert-success alert-dismissible rounded " role="alert">    <strong>Berhasil Menambah Data</strong>    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');

                    $("#notif").addClass('d-none');
                    $("#listnotif").html('');
                    tabel.ajax.reload();
                    $('#adddata').trigger("reset");

                }
            }
        })


    })


    tabel = $("#productss").DataTable({
        columnDefs: [{
                orderable: false,
                targets: 0,
                width: "1%",
            },

            {
                targets: 1,
                width: "25%",

            },
            {
                orderable: false,
                targets: 2,
                width: "20%",

            },
            {
                targets: 3,
                width: "15%",

            },
            {
                targets: 4,
                width: "10%",

            }, {
                targets: 5,
                width: "10%",

            },

        ],
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{route('data.periode')}}",
        },
        columns: [{
                nama: 'DT_RowIndex',
                data: 'DT_RowIndex'
            }, {
                nama: 'nama_periode',
                data: 'nama_periode'
            }, {
                name: 'tahun_ajaran',
                data: 'tahun_ajaran',
            },
            {
                name: 'semester',
                data: 'semester',
            },
            {
                name: 'status',
                data: 'status',
            },
            {
                name: 'aksi',
                data: 'aksi',
            }
        ]
    });

    function del(id) {
        data = confirm("Klik Ok Untuk Melanjutkan");

        if (data) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.LoadingOverlay("show");

            $.ajax({
                url: url + '/admin/data-periode/' + id,
                type: "delete",
                success: function(e) {
                    $.LoadingOverlay("hide");
                    if (e == 'success') {
                        tabel.ajax.reload();
                        $('#suksesnotifd').html('<div class="alert alert-success alert-dismissible rounded " role="alert">    <strong>Berhasil Menghapus Data</strong>    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
                    }
                }
            })

        }
    }
</script>
@endpush