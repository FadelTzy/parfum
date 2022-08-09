@extends('admin.index')

@section('pagecss')
    <link rel="stylesheet" href="{{ asset('asset/css/vendor/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/vendor/datatables.responsive.bootstrap4.min.css') }}">
@endsection


@section('contentpage')
    <div class="row">
        <div class="col-12">
            <h1>Transaksi Baru</h1>
            <div class="top-right-button-container">
            </div>
            <div class="modal fade modal-right" id="exampleModalRight" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalRight" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Produk Baru</h5><button type="button" class="close"
                                data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form id="adddata">
                                @csrf
                                <div class="form-group"><label>Kode Produk</label> <input type="text"
                                        class="form-control" placeholder="input Kode Produk" name="kode"></div>

                                <div class="form-group"><label>Nama Produk</label> <input type="text"
                                        class="form-control" placeholder="input Nama Produk" name="nama"></div>
                                <div class="form-group"><label>Merek Produk</label> <input type="text"
                                        class="form-control" placeholder="input Merek Produk" name="merek"></div>
                                <div class="form-group"><label>Kuantitas</label> <input type="text" class="form-control"
                                        placeholder="input Kuantitas" name="kuantitas"></div>
                                <div class="form-group"><label>Satuan</label> <input type="text" class="form-control"
                                        placeholder="input Satuan" name="satuan"></div>
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenisproduk" id="inlineRadio1"
                                            value="parfum">
                                        <label class="form-check-label" for="inlineRadio1">Parfum</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenisproduk" id="inlineRadio2"
                                            value="botol">
                                        <label class="form-check-label" for="inlineRadio2">Botol</label>
                                    </div>


                                </div>
                                <div class="form-group"><label>Harga</label> <input disabled type="number"
                                        class="form-control" placeholder="..." id="harga" name="harga"></div>
                                <div class="form-group"><label>Gambar</label> <input type="file" class="form-control"
                                        placeholder="input Harga" name="gambar"></div>
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
                            <h5 class="modal-title">Edit Data Produk</h5><button type="button" class="close"
                                data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        </div>
                        <div class="modal-body">
                            <form id="adddatau">
                                @csrf
                                <input type="hidden" id="idu" name="id">
                                <div class="form-group"><label>Kode Produk</label>
                                    <input type="text" class="form-control" id="kodeu"
                                        placeholder="input Kode Produk" name="kode">
                                </div>

                                <div class="form-group"><label>Nama Produk</label>
                                    <input type="text" id="namau" class="form-control"
                                        placeholder="input Nama Produk" name="nama">
                                </div>
                                <div class="form-group">
                                    <label>Merek Produk</label>
                                    <input type="text" class="form-control" id="mereku"
                                        placeholder="input Merek Produk" name="merek">
                                </div>
                                <div class="form-group">
                                    <label>Kuantitas</label> <input type="text" id="kuantitasu" class="form-control"
                                        placeholder="input Kuantitas" name="kuantitas">
                                </div>
                                <div class="form-group"><label>Satuan</label> <input id="satuanu" type="text"
                                        class="form-control" placeholder="input Satuan" name="satuan"></div>
                                <div class="form-group">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenisproduk"
                                            id="inlineRadio1" value="parfum">
                                        <label class="form-check-label" for="inlineRadio1">Parfum</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="jenisproduk"
                                            id="inlineRadio2" value="botol">
                                        <label class="form-check-label" for="inlineRadio2">Botol</label>
                                    </div>


                                </div>
                                <div class="form-group"><label>Harga</label>
                                    <input type="number" class="form-control" id="hargau" placeholder="..."
                                        id="harga" name="harga">
                                </div>
                                <div class="form-group"><label>Gambar</label>
                                    <input type="file" class="form-control" id="gambaru" placeholder="input Harga"
                                        name="gambar">
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
                    <li class="breadcrumb-item"><a href="#">Transaksi</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Baru</li>
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
        <div class="col-md-8 mb-4">
            <div class="card">
                <div class="card-body col-12 mb-4 ">
                    <table id="productss" class="data-table ">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Kode Produk</th>
                                <th>Harga</th>
                                <th>Tambah</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <form method="POST" id="cart">
                    @csrf
                    <div class="card-body">
                        <h5 class="card-title">Recent Orders</h5>
                        <div id="disini" class="scroll dashboard-list-with-thumbs">
                            @foreach ($dB as $item)
                                <div id="segmen{{ $item->id_barang }}">
                                    <div class="d-flex flex-row mb-3"><a class="d-block position-relative"
                                            href="#">
                                            <input type="hidden" name="id_barang[]" value="{{ $item->id_barang }}">
                                            <input type="hidden" name="satuan[]" class="satuanv{{ $item->id_barang }}"
                                                value="{{ $item->jumlah }}">
                                            <input type="hidden" name="nama[]" value="{{ $item->namabarang }}">
                                            <input type="hidden" name="kode[]" value="{{ $item->kodebarang }}">
                                            <input type="hidden" name="gambar[]" value="{{ $item->gambar }}">
                                            <input type="hidden" name="tipe[]" value="{{ $item->tipe }}">
                                            <input type="hidden" name="cc[]" value="{{ $item->satuan }}">
                                            <img src="{{ url('image/produk') }}/{{ 'none.png' }}" alt="Marble Cake"
                                                class="list-thumbnail border-0"> <span
                                                class="badge badge-pill badge-theme-2 position-absolute satuan{{ $item->id_barang }} badge-top-right">{{ $item->jumlah }}</span></a>
                                        <div class="pl-3 pt-2 pr-2 pb-2 w-100">
                                            <div href="#">
                                                <p class="list-item-heading">{{ $item->namabarang }} -
                                                    {{ $item->kodebarang }}
                                                </p>
                                                <div class="pr-4 d-none d-sm-block">
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <div class="input-group mb-2 mr-sm-2">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">Rp</div>
                                                                </div><input type="number" name="harga[]"
                                                                    class="form-control"
                                                                    id="inlineFormInputGroupUsername2"
                                                                    value="{{ $item->harga }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-5">
                                                            <div class="input-group mb-2 mr-sm-2">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">%</div>
                                                                </div><input type="number" name="diskon[]"
                                                                    class="form-control"
                                                                    id="inlineFormInputGroupUsername2">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class=" font-weight-medium d-none d-sm-block">
                                                    <button type="button" class="btn btn-xs btn-danger"
                                                        onclick="hapus({{ $item->id_barang }},{{ $item->jumlah }})"><i
                                                            class="simple-icon-minus"></i></button>
                                                    <button type="button" class="btn btn-xs btn-primary"
                                                        onclick="tambah({{ $item->id_barang }},{{ $item->jumlah }})"><i
                                                            class="simple-icon-plus"></i></button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-end">
                        <button type="button" id="btncart" class="btn btn-sm btn-primary"><b>Pembayaran</b></button>
                    </div>
                </form>

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


        function hapus(id, satuan) {
            var n = parseInt($(".satuan" + id).html());
            console.log(n)
            $(".satuan" + id).html(n - 1);
            $(".satuanv" + id).val(n - 1);

            $.LoadingOverlay("show");
            if (n - 1 == 0) {
                $("#segmen" + id).html('');
            }
            $.ajax({
                url: url + '/admin/basket/remove/',
                type: "post",
                data: {
                    id: id,
                    status: 0,
                    jumlah: n - 1
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
            var n = parseInt($(".satuan" + id).html());
            console.log(n)
            $(".satuan" + id).html(n + 1);
            $(".satuanv" + id).val(n + 1);

            $.LoadingOverlay("show");

            $.ajax({
                url: url + '/admin/basket/remove/',
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

                    

                    }
                },
                complete: function(data) {
                    del();
                }
            })

        }
        $("#submitadd").on('click', function() {
            $("#adddata").trigger('submit');
        });
        $("#btncart").on('click', function() {
            $("#cart").trigger('submit');
        });
        $("#submitaddu").on('click', function() {
            $("#adddatau").trigger('submit');
        });


        tabel = $("#productss").DataTable({
            columnDefs: [{
                    orderable: false,
                    targets: 0,
                    width: "1%",
                },
                {
                    orderable: false,
                    targets: 2,
                    width: "10%",

                },
                {
                    targets: 1,
                    width: "20%",

                },
                {
                    targets: 3,
                    width: "10%",

                },
                {
                    targets: 4,
                    width: "10%",

                },



            ],
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{ route('admin.transak') }}",
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

        function del() {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.LoadingOverlay("show");

            $.ajax({
                url: url + '/admin/basket/check',
                type: "get",
                success: function(e) {
                    $.LoadingOverlay("hide");
                    var bb ;
                    e.forEach(i => {
                        bb += `<div id="segmen${i.id_barang}">
                                    <div class="d-flex flex-row mb-3"><a class="d-block position-relative"
                                            href="#">
                                            <input type="hidden" name="id_barang[]" value="${i.id_barang}">
                                            <input type="hidden" name="satuan[]" class="satuanv${i.id_barang}"
                                                value="${i.jumlah}">
                                            <input type="hidden" name="nama[]" value="${i.namabarang}">
                                            <input type="hidden" name="kode[]" value="${i.kodebarang}">
                                            <input type="hidden" name="gambar[]" value="${i.gambar}">
                                            <input type="hidden" name="tipe[]" value="${i.tipe}">
                                            <input type="hidden" name="cc[]" value="${i.satuan}">
                                            <img src="{{ url('image/produk') }}/{{ 'none.png' }}" alt="Marble Cake"
                                                class="list-thumbnail border-0"> <span
                                                class="badge badge-pill badge-theme-2 position-absolute satuan${i.id_barang} badge-top-right">${i.jumlah}</span></a>
                                        <div class="pl-3 pt-2 pr-2 pb-2 w-100">
                                            <div href="#">
                                                <p class="list-item-heading">${i.namabarang} -
                                                    ${i.kodebarang}
                                                </p>
                                                <div class="pr-4 d-none d-sm-block">
                                                    <div class="row">
                                                        <div class="col-7">
                                                            <div class="input-group mb-2 mr-sm-2">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">Rp</div>
                                                                </div><input type="number" name="harga[]"
                                                                    class="form-control"
                                                                    id="inlineFormInputGroupUsername2"
                                                                    value="${i.harga}">
                                                            </div>
                                                        </div>
                                                        <div class="col-5">
                                                            <div class="input-group mb-2 mr-sm-2">
                                                                <div class="input-group-prepend">
                                                                    <div class="input-group-text">%</div>
                                                                </div><input type="number" name="diskon[]"
                                                                    class="form-control"
                                                                    id="inlineFormInputGroupUsername2">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class=" font-weight-medium d-none d-sm-block">
                                                    <button type="button" class="btn btn-xs btn-danger"
                                                        onclick="hapus(${i.id_barang},${i.jumlah})"><i
                                                            class="simple-icon-minus"></i></button>
                                                    <button type="button" class="btn btn-xs btn-primary"
                                                        onclick="tambah(${i.id_barang},${i.jumlah})"><i
                                                            class="simple-icon-plus"></i></button>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                    });

                    $("#disini").html(bb);
                }
            })


        }
    </script>
@endpush
