@extends('admin.index')

@section('pagecss')
    <link rel="stylesheet" href="{{ asset('asset/css/vendor/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/vendor/datatables.responsive.bootstrap4.min.css') }}">
@endsection


@section('contentpage')
    <div class="row">
        <div class="col-12">
            <h1>Tabel Data Admin</h1>
            <div class="top-right-button-container"><button type="button" class="btn btn-primary btn top-right-button mr-1"
                    data-toggle="modal" data-backdrop="static" data-target="#exampleModalRight"> <i
                        class="simple-icon-magnifier-add"></i> <b> Tambah Admin</b></button>
            </div>
            <div class="modal fade modal-right" id="exampleModalRight" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalRight" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">User sBaru</h5><button type="button" class="close"
                                data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form id="adddata">
                                @csrf
                                <div class="form-group"><label>Nama</label> <input type="text" class="form-control"
                                        placeholder="input nama" name="nama"></div>
                                <div class="form-group"><label>Username</label> <input type="text"
                                        class="form-control" placeholder="input Username" name="username"></div>
                                <div class="form-group"><label>Email</label> <input type="email" class="form-control"
                                        placeholder="input Email" name="email"></div>
                                <div class="form-group"><label>No Hp</label> <input type="text" class="form-control"
                                        placeholder="input No HP" name="no"></div>
                                        <div class="form-group"><label for="inputState">Role</label>
                                             <select name="role" id="inputState" class="form-control">
                                            <option disabled selected="selected">Pilih Tipe Role</option>
                                            <option value="1">Admin</option>
                                            <option value="2">Operator</option>

                                        </select></div>
                                <div class="form-group"><label>Status</label>
                                    <div class="custom-control custom-checkbox"><input name="status" checked type="checkbox"
                                            class="custom-control-input" id="customCheck1"> <label
                                            class="custom-control-label" for="customCheck1">Aktif</label></div>
                                </div>
                            </form>
                        </div>
                        <div class="modal-footer"><button type="button" class="btn btn-outline-primary"
                                data-dismiss="modal">Cancel</button> <button type="button" id="submitadd"
                                class="btn btn-primary">Submit</button></div>
                    </div>
                </div>
            </div>
            <div class="modal fade modal-right" id="exampleModalRightu" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalRight" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Admin</h5><button type="button" class="close"
                                data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form id="adddatau">
                                @csrf
                                <input type="hidden" id="idu" name="id">
                                <div class="form-group"><label>Nama</label> <input type="text" class="form-control"
                                        placeholder="input nama" id="namau" name="nama"></div>
                                <div class="form-group"><label>Username</label> <input type="text"
                                        class="form-control" placeholder="input Username" id="usernameu" name="username">
                                </div>
                                <div class="form-group"><label>Email</label> <input type="email" class="form-control"
                                        placeholder="input Email" id="emailu" name="email"></div>
                                <div class="form-group"><label>No Hp</label> <input type="text" class="form-control"
                                        placeholder="input No HP" id="nou" name="no"></div>
                                <div class="form-group d-flex justify-content-between">
                                    <div>
                                        <label>Status</label>
                                        <div class="custom-control custom-checkbox"><input name="status" id="statusu"
                                                type="checkbox" class="custom-control-input"> <label
                                                class="custom-control-label" for="statusu">Aktif</label>
                                        </div>
                                    </div>
                                    <div>
                                        <label>Password Baru</label>
                                        <div class="custom-control custom-checkbox"><input name="pass" id="statusp"
                                                type="checkbox" class="custom-control-input"> <label
                                                class="custom-control-label" for="statusp">Set</label></div>

                                    </div>
                                </div>

                            </form>
                        </div>
                        <div class="modal-footer"><button type="button" class="btn btn-outline-primary"
                                data-dismiss="modal">Cancel</button> <button type="button" id="submitaddu"
                                class="btn btn-primary">Submit</button></div>
                    </div>
                </div>
            </div>
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item"><a href="#">Data User</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Admin</li>
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

                                <th>Nama</th>
                                <th>No HP</th>
                                <th>Status</th>
                                <th>Role</th>
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
    <script src="{{ asset('asset/js/vendor/datatables.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js
    "></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        url = window.location.origin;

        function upd(id) {
            console.log(id);
            $("#idu").val(id.id);
            $("#namau").val(id.name);
            $("#usernameu").val(id.username);
            $("#nou").val(id.no_hp);
            $("#emailu").val(id.email);
            if (id.status == 1) {
                $("#statusu").prop('checked', true);
            } else {
                $("#statusu").prop('checked', false);
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
                url: '{{ route('data.adminsave') }}',
                data: data,
                type: "POST",
                success: function(id) {
                    console.log(id);
                    $.LoadingOverlay("hide");

                    if (id.status == 'error') {
                        var data = id.data;
                        var elem;
                        var result = Object.keys(data).map((key) => [data[key]]);
                        elem =
                            '<div class="alert alert-danger alert-dismissible fade show pt-3" role="alert">';
                        elem +=
                            '   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span> </button><ul>';
                        result.forEach(function(data) {
                            elem += '<li>' + data[0][0] + '</li>';
                        });
                        elem += '</ul></div>';
                        $("#notif").removeClass('d-none');
                        $("#listnotif").html(elem);
                    } else {
                        $('#exampleModalRight').modal('hide');
                        $('#suksesnotif').html(
                            '<div class="alert alert-success alert-dismissible rounded " role="alert">    <strong>Berhasil Menambah Data</strong>    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                            );

                        $("#notif").addClass('d-none');
                        $("#listnotif").html('');
                        tabel.ajax.reload();
                        $('#adddata').trigger("reset");

                    }
                }
            })


        })
        $("#adddatau").on('submit', function(id) {
            id.preventDefault();
            var data = $(this).serialize();
            $.LoadingOverlay("show");


            $.ajax({
                url: '{{ route('data.adminedit') }}',
                data: data,
                type: "PUT",
                success: function(id) {
                    console.log(id);
                    $.LoadingOverlay("hide");

                    if (id.status == 'error') {
                        var data = id.data;
                        var elem;
                        var result = Object.keys(data).map((key) => [data[key]]);
                        elem =
                            '<div class="alert alert-danger alert-dismissible fade show pt-3" role="alert">';
                        elem +=
                            '   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span> </button><ul>';
                        result.forEach(function(data) {
                            elem += '<li>' + data[0][0] + '</li>';
                        });
                        elem += '</ul></div>';
                        $("#notif").removeClass('d-none');
                        $("#listnotif").html(elem);
                    } else {
                        $('#exampleModalRightu').modal('hide');
                        $('#suksesnotifu').html(
                            '<div class="alert alert-success alert-dismissible  rounded " id="suksesnotifu" role="alert">    <strong>Berhasil Mengubah Data</strong>    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                            );



                        $("#notif").addClass('d-none');
                        $("#listnotif").html('');
                        tabel.ajax.reload();

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
                    orderable: false,
                    targets: 2,
                    width: "15%",

                },
                {
                    targets: 1,
                    width: "15%",

                },
                {
                    targets: 3,
                    width: "10%",

                },
                {
                    targets: 4,
                    width: "10%",

                },
                {
                    targets: 5,
                    width: "10%",
                    orderable: false,

                },

            ],
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('data.admin') }}",
            },
            columns: [{
                    nama: 'DT_RowIndex',
                    data: 'DT_RowIndex'
                }, {
                    nama: 'nama',
                    data: 'nama'
                }, {
                    name: 'no_hp',
                    data: 'no_hp',
                }, {
                    name: 'status',
                    data: 'status'
                },
                {
                    name: 'role',
                    data: 'role'
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
                    url: url + '/admin/data-admin/' + id,
                    type: "delete",
                    success: function(e) {
                        $.LoadingOverlay("hide");
                        if (e == 'success') {
                            tabel.ajax.reload();
                            $('#suksesnotifd').html(
                                '<div class="alert alert-success alert-dismissible rounded " role="alert">    <strong>Berhasil Menghapus Data</strong>    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                                );
                        }
                    }
                })

            }
        }
    </script>
@endpush
