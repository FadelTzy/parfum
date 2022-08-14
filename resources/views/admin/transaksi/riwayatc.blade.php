@extends('admin.index')

@section('pagecss')
    <link rel="stylesheet" href="{{ asset('asset/css/vendor/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/vendor/datatables.responsive.bootstrap4.min.css') }}">
@endsection


@section('contentpage')
    <div class="row">
        <div class="col-12">
            <h1>Riwayat Transaksi -  {{$dC->nama_c}} </h1>
            <div class="top-right-button-container"><a type="button" class="btn btn-primary btn top-right-button mr-1"
                    href="{{route('admin.transak')}}"> <i
                        class="simple-icon-magnifier-add"></i> <b> Transaksi Baru</b></a>
            </div>
      
            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item"><a href="#">Data Master</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
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
                <div class="card-body col-12 mb-4 data-table-rows data-tables-hide-filter">
                    <table id="productss" class="data-table ">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Pemesanan</th>
                                <th>Pembeli</th>
                                <th>Status</th>
                                <th>Pembayaran</th>
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
            $('input:radio[name=jenisproduk][value="'+id.jenis+'"]').attr('checked', true);
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
                url: '{{ route('barang.store') }}',
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
                    width: "5%",

                },
                {
                    targets: 1,
                    width: "5%",

                },
                {
                    targets: 3,
                    width: "15%",

                },
                {
                    targets: 4,
                    width: "15%",

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
                url: url + "/admin/riwayat-transaksi/" + "{{ Request::segment(3) }}",
            },
            columns: [{
                    nama: 'DT_RowIndex',
                    data: 'DT_RowIndex'
                }, {
                    nama: 'tanggalnya',
                    data: 'tanggalnya'
                }, {
                    name: 'namanya',
                    data: 'namanya',
                }, {
                    name: 'statusnya',
                    data: 'statusnya'
                },
             
                {
                    name: 'harganya',
                    data: 'harganya'
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
                    url: url + '/admin/transaksi/' + id,
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
