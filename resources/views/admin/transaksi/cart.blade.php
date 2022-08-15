@extends('admin.index')

@section('pagecss')
    <link rel="stylesheet" href="{{ asset('asset/css/vendor/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/vendor/datatables.responsive.bootstrap4.min.css') }}">
@endsection


@section('contentpage')
    <div class="row app-row">
        <div class="col-12">
            <div class="mb-2">
                <h1>Keranjang Pembelanjaan</h1>
                <div class="top-right-button-container"><button type="button"
                        class="btn btn-outline-primary btn-lg top-right-button mr-1" data-toggle="modal"
                        data-target="#exampleModalPopovers">Bayar</button>
                    <div class="modal fade modal-right" id="exampleModal" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Add New</h5><button type="button"
                                        class="close" data-dismiss="modal" aria-label="Close"><span
                                            aria-hidden="true">&times;</span></button>
                                </div>
                                <div class="modal-body">
                                    <form>
                                        <div class="form-group"><label>Title</label> <input type="text"
                                                class="form-control" placeholder=""></div>
                                        <div class="form-group"><label>Details</label>
                                            <textarea class="form-control" rows="2"></textarea>
                                        </div>
                                        <div class="form-group"><label>Category</label> <select
                                                class="form-control select2-single" data-width="100%">
                                                <option label="&nbsp;">&nbsp;</option>
                                                <option value="Flexbox">Flexbox</option>
                                                <option value="Sass">Sass</option>
                                                <option value="React">React</option>
                                            </select></div>
                                        <div class="form-group"><label>Labels</label> <select
                                                class="form-control select2-multiple" multiple="multiple" data-width="100%">
                                                <option value="New Framework">New Framework</option>
                                                <option value="Education">Education</option>
                                                <option value="Personal">Personal</option>
                                            </select></div>
                                        <div class="form-group"><label>Status</label>
                                            <div class="custom-control custom-checkbox"><input type="checkbox"
                                                    class="custom-control-input" id="customCheck1"> <label
                                                    class="custom-control-label" for="customCheck1">Completed</label></div>
                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer"><button type="button" class="btn btn-outline-primary"
                                        data-dismiss="modal">Cancel</button> <button type="button"
                                        class="btn btn-primary">Submit</button></div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="mb-2"><a class="btn pt-0 pl-0 d-inline-block d-md-none" data-toggle="collapse"
                    href="#displayOptions" role="button" aria-expanded="true" aria-controls="displayOptions">Display
                    Options <i class="simple-icon-arrow-down align-middle"></i></a>
                <div class="collapse d-md-block" id="displayOptions">
                    <div class="d-block d-md-inline-block">
                        <div class="btn-group float-md-left mr-1 mb-1">
                            <b>Tanggal Pemesanan : {{ $date }}</b>
                        </div>

                    </div>
                </div>
            </div>
            <div class="alert alert-danger d-none" id="notif" role="alert">
                <div id="listnotif">

                </div>
            </div>

            <div id="suksesnotif"></div>
            <div id="suksesnotifu"></div>
            <div id="suksesnotifd"></div>
            <div class="separator mb-5"></div>
            <div class="card">
                <div class="card-body">
                    <div class="card-body col-12 mb-4 ">

                        <table id="productss" class="table table-bordered table-hover ">
                            <thead>
                                <tr>
                                    <th rowspan="2">No</th>
                                    <th rowspan="2">Kode</th>
                                    <th rowspan="2">Barang</th>
                                    <th rowspan="2">Jumlah</th>
                                    <th rowspan="2">Satuan</th>
                                    <th rowspan="2">Disc</th>
                                    <th class="text-center" colspan="2">Dollar $</th>
                                    <th class="text-center" colspan="2">Rupiah Rp</th>

                                </tr>
                                <tr>
                                    <th>Harga</th>
                                    <th>Total</th>
                                    <th>Harga</th>
                                    <th>Total</th>
                                </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div id="exampleModalPopovers" class="modal fade show" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form id="formbayar" action="">
                    <input type="hidden" name="id" value="{{ $dT->id }}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalPopoversLabel">Notifikasi Pembayaran</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>
                    <div class="modal-body">
                        <h5>Detail Pembelanjaan</h5>
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 35%">Jumlah Barang</th>
                                <th style="width: 5%"> : </th>
                                <th id="mtotbar"></th>
                                <input type="hidden" name="jumlah" id="vmtotbar">
                            </tr>
                            <tr>
                                <th>Harga</th>
                                <th> : </th>
                                <th id="mharga"></th>
                                <input type="hidden" name="harga" id="vmharga">
                            </tr>
                            <tr>
                                <th>Harga Diskon</th>
                                <th> : </th>
                                <th id="mdiskon"></th>
                                <input type="hidden" name="diskon" id="vmdiskon">
                            </tr>
                            <tr>
                                <th>Total Harga</th>
                                <th> : </th>
                                <th id="mtothar"></th>
                                <input type="hidden" name="totalharga" id="vmtothar">
                            </tr>
                            <tr>
                                <th colspan="3"></th>
                            </tr>
                            <tr>
                                <th>Metode Pembayaran</th>
                                <th> : </th>
                                <th>
                                    <div class="custom-control custom-radio"><input type="radio" id="customRadio1"
                                            name="metode" value="Tunai" class="custom-control-input"> <label
                                            class="custom-control-label" for="customRadio1">Tunai / Cash</label>
                                    </div>
                                    <div class="custom-control custom-radio"><input type="radio" id="customRadio"
                                            name="metode" value="Transfer" class="custom-control-input"> <label
                                            class="custom-control-label" for="customRadio">Transfer</label></div>
                                </th>
                            </tr>
                        </table>
                    </div>
                </form>
                <div class="modal-footer"><button type="button" class="btn btn-secondary"
                        data-dismiss="modal">Tutup</button>
                    <button id="btnbayar" type="button" class="btn btn-primary">Simpan</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-sm-d" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Harga <span id="tipeKurs">.html('Dollar');</span></h5><button
                        type="button" class="close"else{ } data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form id="formharga" action="">
                        <label id="labelkodenama"></label>
                        <input type="hidden" name="id" id="idu">
                        <input type="text" name="harga" class="form-control mb-2" id="hargau">
                        <button type="button" class="text-end btn btn-sm btn-warning" id="submitharga">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade modal-sm-dis" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Edit Diskon </h5><button type="button" class="close" data-dismiss="modal"
                        aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <form id="formdiskon" action="">
                        <label id="labelkodenamad"></label>
                        <input type="hidden" name="id" id="iduu">
                        <input type="text" name="diskon" class="form-control mb-2" id="diskonu">
                        <button type="button" class="text-end btn btn-sm btn-warning" id="submitdiskon">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <a href="#" id="notifSuccess" class="btn btn-outline-success rounded notify-btn mb-1" data-from="top"
                data-align="right" data-color="success" data-status="Berhasil" data-teks="Data Transaksi Tersimpan"></a>
            <a href="#" id="notifDanger" class="btn btn-outline-danger rounded notify-btn mb-1" data-from="top"
                data-align="right" data-color="danger" data-status="Gagal" data-teks="Terjadi Kesalahan"></a>
        </div>
    </div>
    <div class="modal fade modalpelanggan" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5>Daftar Pelanggan</h5>
                </div>
                <div class="modal-body">
                    <div class="card-body col-12 mb-4 ">

                        <table id="pelanggans" class="table table-bordered table-hover ">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>No Hp</th>
                                    <th>Kredit</th>
                                    <th>Debit</th>
                                    <th>Aksi</th>

                                </tr>

                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('appmenu')
    <div class="app-menu">
        <div class="p-4 h-100">
            <div class="scroll">
                <form id="formcart">
                    <p class="text-muted text-small">Status</p>
                    <ul class="list-unstyled mb-5">
                        <li class="">
                            <a href="#">Status Pembelian
                                <span class="float-right">
                                    @if ($dT->status == 1)
                                        Lunas
                                    @else
                                        Belum Lunas
                                    @endif
                                </span>
                            </a>
                        </li>
                        <li class="">Tanggal Pemesanan<span
                                class="float-right">{{ $dT->tanggalpesan ?? '-' }}</span></li>
                        <li class="">Tanggal Pembayaran<span
                                class="float-right">{{ $dT->tanggalbayar ?? '-' }}</span></li>
                        <li class="">No Pemesanan

                            <span class="float-right">{{ $dT->nopemesanan ?? '-' }}</span>

                        </li>
                        <li class=""><a type="button" onclick="daftar()" href="#"> Pelanggan
                                <span id="namapelanggan" class="float-right">{{ $dT->oCustomer->nama_c ?? 'Guest' }}</span>
                            </a></li>
                            <input type="hidden" name="idpelanggan" value="{{ $dT->oCustomer->id ?? null}} " id="idpelangganv">

                    </ul>
                    <p class="text-muted text-small">Harga</p>
                    <input type="hidden" name="id" value="{{ $dT->id }}">

                    <ul class="list-unstyled mb-5">
                        <li class="">Total Barang
                            <span class="float-right" id="totalbarangnya"></span>
                            <input type="hidden" name="total" id="itotalbarangnya">
                        </li>
                        <li class="">Harga
                            <span class="float-right" id="totalharganya"></span>
                            <input type="hidden" name="harga" id="itotalharganya">
                        </li>
                        <li class="">Diskon
                            <span class="float-right" id="diskonharganya"></span>
                            <input type="hidden" name="diskon" id="idiskonharganya">
                        </li>
                        <li class="">Total Harga
                            <span class="float-right" id="hargasebenarnya"></span>
                            <input type="hidden" name="totalharga" id="ihargasebenarnya">
                        </li>
                    </ul>
                    <div>
                        <p class="d-sm-inline-block mb-1">
                            <button type="button" id="simpancart"
                                class="btn btn-sm btn-outline-primary mb-1">Simpan</button>
                                <button type="button" onclick="del({{$dT->id}})" id="hapusTransak"
                                class="btn btn-sm btn-outline-danger mb-1">Hapus</button>
                            @if ($dT->status == 1)
                                <button type="button" class="btn btn-sm btn-outline-warning mb-1">Cetak</button>
                            @endif
                        </p>
                    </div>
                </form>
            </div>
        </div><a class="app-menu-button d-inline-block d-xl-none" href="#"><i class="simple-icon-options"></i></a>
    </div>
@endsection
@push('pagejs')
    <script src="{{ asset('asset/js/vendor/datatables.min.js') }}"></script>
    <script src="{{ asset('asset/js/vendor/bootstrap-notify.min.js') }}"></script>

    <script
        src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js
                                                                                                                                                                                                                        ">
    </script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        url = window.location.origin;

        function daftar() {
            $(".modalpelanggan").modal("show")
            $("#pelanggans").dataTable().fnDestroy()

            $("#pelanggans").DataTable({

                "ordering": false,
                columnDefs: [{
                        targets: 0,
                        width: "1%",
                    },
                    {
                        targets: 1,
                        width: "15%",

                    },
                    {
                        orderable: false,
                        targets: 2,
                        width: "15%",

                    },

                    {
                        targets: 3,
                        width: "20%",

                    },
                    {
                        targets: 4,
                        width: "5%",

                    },
                    {
                        targets: 5,
                        width: "5%",
                        orderable: false,

                    },

                ],
                order: [],
                processing: true,
                serverSide: true,
                ajax: {
                    url: url + '/admin/daftar-pelanggan/',
                },
                columns: [{
                        nama: 'DT_RowIndex',
                        data: 'DT_RowIndex'
                    }, {
                        nama: 'nama_c',
                        data: 'nama_c'
                    }, {
                        name: 'hp_c',
                        data: 'hp_c',
                    }, {
                        name: 'kreditnya',
                        data: 'kreditnya'
                    },
                    {
                        name: 'debitnya',
                        data: 'debitnya'
                    },
                    {
                        name: 'aksi',
                        data: 'aksi'
                    },

                ]
            });
        }

        function formatRupiah(angka, prefix) {
            var number_string = angka.replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

        function hapus(id, satuan) {

            $.LoadingOverlay("show");

            $.ajax({
                url: url + '/admin/basket/remove2/',
                type: "post",
                data: {
                    id: id,
                    status: 0,
                },
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

        function tambah(id, satuan) {

            console.log(id, satuan);
            $.LoadingOverlay("show");

            $.ajax({
                url: url + '/admin/basket/remove2/',
                type: "post",
                data: {
                    id: id,
                    status: 1,
                },
                success: function(e) {
                    $.LoadingOverlay("hide");
                    if (e == 'success') {
                        tabel.ajax.reload();
                        $('#suksesnotifd').html(
                            '<div class="alert alert-success alert-dismissible rounded " role="alert">    <strong>Berhasil Menambah Data</strong>    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                        );
                    }
                }
            })
        }

        function upd(id) {
            console.log(id);
            $.LoadingOverlay("show");

            $.ajax({
                url: '{{ route('admin.basketsave') }}',
                data: id,
                type: "POST",
                success: function(id) {
                    console.log(id);
                    $.LoadingOverlay("hide");

                    if (id.status == 'error') {
                        var data = id.data;
                        var elem;

                        $("#notif").removeClass('d-none');
                        $("#listnotif").html(elem);
                    } else {
                        $('#exampleModalRight').modal('hide');
                        $('#suksesnotif').html(
                            '<div class="alert alert-success alert-dismissible rounded " role="alert">    <strong>Berhasil Menambah Data</strong>    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                        );

                        $("#notif").addClass('d-none');
                        $("#listnotif").html('');
                        $('#adddata').trigger("reset");

                    }
                }
            })

        }
        $("#submitadd").on('click', function() {
            $("#adddata").trigger('submit');
        });
        $("#btncart").on('click', function() {
            $("#cart").trigger('submit');
        });
        $("#simpancart").on('click', function() {
            $("#formcart").trigger('submit');
        });
        $("#btnbayar").on('click', function() {
            $("#formbayar").trigger('submit');
        });
        $("#submitaddu").on('click', function() {
            $("#adddatau").trigger('submit');
        });
        $("#submitharga").on('click', function() {
            $("#formharga").trigger('submit');
        });
        $("#formcart").on('submit', function(id) {
            id.preventDefault();
            var data = new FormData(this);
            $.LoadingOverlay("show");

            $.ajax({
                url: '{{ route('admin.simpan') }}',
                data: data,
                type: "POST",
                contentType: false,
                processData: false,
                success: function(id) {
                    console.log(id);
                    $.LoadingOverlay("hide");

                    if (id.status == 'error') {
                        var data = id.data;
                        $("#notifDanger").trigger('click')


                    } else {

                        $("#notifSuccess").trigger('click')
                    }
                }
            })


        })
        $("#formbayar").on('submit', function(id) {
            id.preventDefault();
            var data = new FormData(this);
            $.LoadingOverlay("show");

            $.ajax({
                url: '{{ route('admin.bayar') }}',
                data: data,
                type: "POST",
                contentType: false,
                processData: false,
                success: function(id) {
                    console.log(id);
                    $.LoadingOverlay("hide");
                    $("#exampleModalPopovers").modal('hide');
                    if (id.status == 'error') {
                        var data = id.data;
                        $("#notifDanger").trigger('click')

                    } else {

                        $("#notifSuccess").trigger('click')
                    }
                }
            })


        })
        $("#formharga").on('submit', function(id) {
            id.preventDefault();
            var data = new FormData(this);
            $.LoadingOverlay("show");

            $.ajax({
                url: '{{ route('admin.basketeditharga') }}',
                data: data,
                type: "POST",
                contentType: false,
                processData: false,
                success: function(id) {
                    console.log(id);
                    $.LoadingOverlay("hide");

                    if (id.status == 'error') {
                        var data = id.data;

                        $("#notif").removeClass('d-none');
                        $("#listnotif").html(id);
                    } else {
                        $('#suksesnotif').html(
                            '<div class="alert alert-success alert-dismissible rounded " role="alert">    <strong>Berhasil Menambah Data</strong>    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                        );

                        $("#notif").addClass('d-none');
                        $("#listnotif").html('');
                        tabel.ajax.reload();
                        $(".modal-sm-d").modal('hide');

                    }
                }
            })


        })
        $("#submitdiskon").on('click', function() {
            $("#formdiskon").trigger('submit');
        });
        $("#formdiskon").on('submit', function(id) {
            id.preventDefault();
            var data = new FormData(this);
            $.LoadingOverlay("show");

            $.ajax({
                url: '{{ route('admin.basketeditdiskon') }}',
                data: data,
                type: "POST",
                contentType: false,
                processData: false,
                success: function(id) {
                    console.log(id);
                    $.LoadingOverlay("hide");

                    if (id.status == 'error') {
                        var data = id.data;

                        $("#notif").removeClass('d-none');
                        $("#listnotif").html(id);
                    } else {
                        $('#suksesnotif').html(
                            '<div class="alert alert-success alert-dismissible rounded " role="alert">    <strong>Berhasil Menambah Data</strong>    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                        );

                        $("#notif").addClass('d-none');
                        $("#listnotif").html('');
                        tabel.ajax.reload();
                        $(".modal-sm-dis").modal('hide');

                    }
                }
            })


        })
        const rupiah = (number) => {
            return new Intl.NumberFormat("id-ID", {
                style: "currency",
                currency: "IDR"
            }).format(number);
        }
        tabel = $("#productss").DataTable({
            "drawCallback": function(settings, k) {
                var d = $('#productss').DataTable();
                var l = d.column(10).data()
                    .reduce(function(a, b) {
                        return a + b;
                    });
                var dis = d.column(11).data()
                    .reduce(function(a, b) {
                        return a + b;
                    });
                $("#totalharganya").html(rupiah(l))
                $("#itotalharganya").val(l)

                $("#diskonharganya").html(rupiah(dis))
                $("#idiskonharganya").val(dis)

                $("#hargasebenarnya").html(rupiah(l - dis))
                $("#ihargasebenarnya").val(l - dis)

                $("#totalbarangnya").html(d.column(10).data().count())
                $("#itotalbarangnya").val(d.column(10).data().count())

                $("#mharga").html(rupiah(l))
                $("#vmharga").val(l)

                $("#mdiskon").html(rupiah(dis))
                $("#vmdiskon").val(dis)

                $("#mtothar").html(rupiah(l - dis))
                $("#vmtothar").val(l - dis)

                $("#mtotbar").html(d.column(10).data().count())
                $("#vmtotbar").val(d.column(10).data().count())

            },
            "ordering": false,
            columnDefs: [{
                    targets: 0,
                    width: "1%",
                },
                {
                    targets: 1,
                    width: "15%",

                },
                {
                    orderable: false,
                    targets: 2,
                    width: "15%",

                },

                {
                    targets: 3,
                    width: "20%",

                },
                {
                    targets: 4,
                    width: "5%",

                },
                {
                    targets: 5,
                    width: "5%",
                    orderable: false,

                },
                {
                    targets: 6,
                    width: "10%",
                    orderable: false,

                },
                {
                    targets: 7,
                    width: "10%",
                    orderable: false,

                },
                {
                    targets: 8,
                    width: "10%",
                    orderable: false,

                },
                {
                    targets: 9,
                    width: "10%",
                    orderable: false,

                },
                {
                    targets: 10,
                    visible: false
                },
                {
                    targets: 11,
                    visible: false
                },
            ],
            order: [],
            processing: true,
            serverSide: true,
            ajax: {
                url: url + '/admin/cart/' + "{{ Request::segment(3) }}",
            },
            columns: [{
                    nama: 'DT_RowIndex',
                    data: 'DT_RowIndex'
                }, {
                    nama: 'kodebarang',
                    data: 'kodebarang'
                }, {
                    name: 'namabarang',
                    data: 'namabarang',
                }, {
                    name: 'btnsatuan',
                    data: 'btnsatuan'
                },
                {
                    name: 'satuan',
                    data: 'satuan'
                },
                {
                    name: 'dsc',
                    data: 'dsc',
                },
                {
                    name: 'do',
                    data: 'do',
                },
                {
                    name: 'dt',
                    data: 'dt',
                },
                {
                    name: 'ro',
                    data: 'ro',
                },
                {
                    name: 'rt',
                    data: 'rt',
                },
                {
                    name: 'totals',
                    data: 'totals',
                },
                {
                    name: 'diskonnya',
                    data: 'diskonnya',
                }
            ]
        });
        $("#cart").on('submit', function(id) {
            id.preventDefault();
            var data = new FormData(this);
            $.LoadingOverlay("show");


            $.ajax({
                url: '{{ route('admin.basket') }}',
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
                        $('#suksesnotif').html(
                            '<div class="alert alert-success alert-dismissible rounded " role="alert">    <strong>Berhasil Menambah Data</strong>    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                        );
                        window.open(url + '/admin/cart/' + id);

                        $("#notif").addClass('d-none');
                        $("#listnotif").html('');
                        tabel.ajax.reload();

                    }
                }
            })


        })

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
                        // window.open(url + '/admin/transaksi');
                        window.location.replace(url + '/admin/transaksi');

                    }
                })

            }
        }

        function changeD(id) {
            console.log(id);
            $("#idu").val(id.id);
            $("#hargau").val(id.harga);
            $("#labelkodenama").html(id.kodebarang + ' - ' + id.namabarang);
            $(".modal-sm-d").modal('show');
            if (id.tipe == 'parfum') {
                $("#tipeKurs").html('Dollar');
            } else {
                $("#tipeKurs").html('Rupiah');
            }
        }

        function changeDiskon(id) {
            console.log(id);
            $("#iduu").val(id.id);
            $("#diskonu").val(id.diskon);
            $("#labelkodenamad").html(id.kodebarang + ' - ' + id.namabarang);
            $(".modal-sm-dis").modal('show');

        }

        function ubahnama(id) {
            console.log(id);
            $("#namapelanggan").html(id.nama_c)
            $("#idpelangganv").val(id.id)
            $(".modalpelanggan").modal('hide');
        }
    </script>
@endpush
