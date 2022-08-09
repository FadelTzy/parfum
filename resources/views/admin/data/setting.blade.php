@extends('admin.index')

@section('pagecss')
    <link rel="stylesheet" href="{{ asset('asset/css/vendor/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/vendor/datatables.responsive.bootstrap4.min.css') }}">
@endsection


@section('contentpage')
    <div class="row">
        <div class="col-12">
            <h1>Data Nota</h1>
            <div class="top-right-button-container"><button type="button" class="btn btn-primary btn top-right-button mr-1"
                    data-toggle="modal" data-backdrop="static" data-target="#exampleModalRight"> <i
                        class="simple-icon-magnifier-add"></i> <b> Edit Konfigurasi</b></button>
            </div>
            <div class="modal fade modal-right" id="exampleModalRight" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalRight" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">konfigurasi Baru</h5><button type="button" class="close"
                                data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form id="adddata">
                                @csrf
                                <div class="form-group"><label for="nama_app">Nama Aplikasi</label> <input type="text"
                                        class="form-control" id="nama_app" name="nama_app"
                                        value="{{ $setting->nama_app ?? '' }}">
                                </div>

                                <div class="form-group"><label for="alamat">Alamat</label> <input type="text"
                                        class="form-control" id="alamat" name="alamat"
                                        value="{{ $setting->alamat ?? '' }}">
                                </div>

                                <div class="form-group"><label for="notelp">Nomor Telepon</label> <input type="text"
                                        class="form-control" id="notelp" name="notelp"
                                        value="{{ $setting->notelp ?? '' }}">
                                </div>

                                <div class="form-group"><label for="kurs">Kurs</label> <input type="text"
                                        class="form-control" id="kurs" name="kurs"
                                        value="{{ $setting->kurs ?? '' }}">
                                </div>

                                <div class="form-group"><label for="kecamatan">Kecamatan</label> <input type="text"
                                        class="form-control" id="kecamatan" name="kecamatan"
                                        value="{{ $setting->kecamatan ?? '' }}">
                                </div>

                                <div class="form-group"><label for="atm">Nomor ATM</label> <input type="text"
                                        class="form-control" id="atm" name="atm"
                                        value="{{ $setting->atm ?? '' }} "></div>


                                <div class="form-group"><label for="logo">Logo</label> <input type="file"
                                        class="form-control" id="logo" name="logo"> </div>
                            </form>
                        </div>
                        <div class="modal-footer"><button type="button" class="btn btn-outline-primary"
                                data-dismiss="modal">Cancel</button> <button type="button" id="submitadd"
                                class="btn btn-primary">Submit</button></div>
                    </div>
                </div>
            </div>

            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Nota</li>
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

    <div class="card mb-4">
        <div class="card-body">
            <h5 class="mb-4">Nota</h5>
            <form>
                <div class="form-group"><label for="nama_app">Nama Aplikasi</label> <input type="text"
                        class="form-control" id="nama_app" name="nama_app" readonly
                        value="{{ $setting->nama_app ?? '' }}">
                </div>

                <div class="form-group"><label for="alamat">Alamat</label> <input type="text" class="form-control"
                        id="alamat" name="alamat" readonly value="{{ $setting->alamat ?? '' }}"> </div>

                <div class="form-group"><label for="notelp">Nomor Telepon</label> <input type="text"
                        class="form-control" id="notelp" name="notelp" readonly
                        value="{{ $setting->notelp ?? '' }}">
                </div>

                <div class="form-group"><label for="kurs">Kurs</label> <input type="text" class="form-control"
                        id="kurs" name="kurs" readonly value="{{ $setting->kurs ?? '' }}"> </div>

                <div class="form-group"><label for="kecamatan">Kecamatan</label> <input type="text"
                        class="form-control" id="kecamatan" name="kecamatan" readonly
                        value="{{ $setting->kecamatan ?? '' }}">
                </div>

                <div class="form-group"><label for="atm">Nomor ATM</label> <input type="text"
                        class="form-control" id="atm" name="atm" readonly value="{{ $setting->atm ?? '' }}">
                </div>


                <div class="form-group"><label for="atm">Logo</label>
                    <br>
                    @php
                        $logo = $setting->logo ?? '';
                    @endphp
                    @if ($logo == '')
                        <img src="https://upload.wikimedia.org/wikipedia/commons/6/65/No-Image-Placeholder.svg"
                            height="200" alt="">
                    @else
                        <img src="{{ url('image/logoapp/' . $setting->logo) }}" alt="" height="200">
                    @endif
                </div>

            </form>
        </div>
    </div>
@endsection

@push('pagejs')
    <script src="{{ asset('asset/js/vendor/datatables.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js">
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        url = window.location.origin;
        $('input[type=radio][name=jenisproduk]').change(function() {
            if (this.value == 'parfum') {
                $("#harga").attr("placeholder", 'input Dollar $');
            } else if (this.value == 'botol') {
                $("#harga").attr("placeholder", 'input Rupiah Rp.');
            }
            $("#harga").removeAttr("disabled");

        });

        function upd(id) {
            console.log(id);
            $("#idu").val(id.id);
            $("#namau").val(id.nama);
            $("#kodeu").val(id.kode);
            $("#mereku").val(id.merek);
            $("#hargau").val(id.harga);

            $("#satuanu").val(id.satuan);
            $("#kuantitasu").val(id.jumlah);
            $('input:radio[name=jenisproduk][value="' + id.jenis + '"]').attr('checked', true);

        }
        $("#submitadd").on('click', function() {
            $("#adddata").trigger('submit');
        });
        $("#submitaddu").on('click', function() {
            $("#adddatau").trigger('submit');
        });
        $("#adddata").on('submit', function(id) {
            id.preventDefault();
            var data = new FormData(this);
            $.LoadingOverlay("show");
            $.ajax({
                url: '{{ route('setting.update') }}',
                data: data,
                type: "POST",

                contentType: false,
                processData: false,
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
                        location.reload();

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
            var data = new FormData(this);
            $.LoadingOverlay("show");


            $.ajax({
                url: '{{ route('barang.update') }}',
                data: data,
                type: "POST",

                contentType: false,
                processData: false,
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
                {
                    targets: 6,
                    width: "10%",
                    orderable: false,

                },

            ],
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('barang.index') }}",
            },
            columns: [{
                    nama: 'DT_RowIndex',
                    data: 'DT_RowIndex'
                }, {
                    nama: 'namanya',
                    data: 'namanya'
                }, {
                    name: 'kode',
                    data: 'kode',
                }, {
                    name: 'merek',
                    data: 'merek'
                },
                {
                    name: 'kuantitasnya',
                    data: 'kuantitasnya'
                },
                {
                    name: 'harga',
                    data: 'harga'
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
                    url: url + '/admin/data-barang/' + id,
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
