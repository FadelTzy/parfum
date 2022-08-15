@extends('admin.index')

@section('pagecss')
<link rel="stylesheet" href="{{asset('asset/css/vendor/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('asset/css/vendor/datatables.responsive.bootstrap4.min.css')}}">
@endsection


@section('contentpage')
<div class="row">
    <div class="col-12">
        <h1>Profil</h1>

        <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
            <ol class="breadcrumb pt-0">
                <li class="breadcrumb-item"><a href="#">Admin</a></li>
                <li class="breadcrumb-item"><a href="#">Profil</a></li>
            </ol>
        </nav>
        <div class="separator mb-5"></div>
    </div>
</div>
<div id="listnotif">

</div>

<div class="row mb-4">
    <div class="col-md-12 col-lg-12 col-12 mb-4">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="{{asset('image/fotomhs/')}}/{{Auth::user()->foto ?? 'none.jpg'}}" alt="Detail Picture" class="mx-auto w-50">
                            <div class="card-body">


                                <form id="gambar" class="row">
                                    <div class="col-8">
                                        <input type="file" name="thumbnail" id="customFile" class="form-control mb-2 ">

                                    </div>

                                    <div class="col-4">
                                        <button type="submit" class="btn btn-sm btn-outline-primary mb-2">Ubah</button>
                                    </div>
                                    <div class="col-12">
                                        <div class="d-none" id="infoimage">tes</div>
                                    </div>

                                </form>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card mb-4">
                            <div class="card-body ">
                                <table class="table mb-2">
                                    <tbody>
                                        <tr>
                                            <td style="width: 20%;">Nama</td>
                                            <td style="width: 3%;">:</td>
                                            <td>{{Auth::user()->name}}</td>
                                        </tr>
                                        <tr>
                                            <td>username</td>
                                            <td>:</td>
                                            <td>{{Auth::user()->username}}</td>
                                        </tr>
                                        <tr>
                                            <td>No HP</td>
                                            <td>:</td>
                                            <td>{{Auth::user()->no_hp}}</td>
                                        </tr>

                                    </tbody>
                                </table>
                                <p class="mb-1">Ubah Password</p>

                                <form id="password" class="form-inline w-100">
                                    <input type="password" class="form-control mb-2 mr-sm-2" name="password" placeholder="Password">
                                    <input type="password" class="form-control mb-2 mr-sm-2" name="password_confirmation" placeholder="Konfirmasi Password">
                                    <button type="submit" class="btn btn-sm btn-outline-primary mb-2">Ubah</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<div id="suksesnotif"></div>

<div id="suksesnotifu"></div>
<div id="suksesnotifd"></div>


@endsection

@push('pagejs')
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js
"></script>
<script>
    var url = window.location.origin;
    var tabel;
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function sizeCheck(bytes) {
        if (bytes == 0) return '0 Byte';
        var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
        return Math.round(bytes / Math.pow(1024, i), 2);
    }

    function bytesToSize(bytes) {
        var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        if (bytes == 0) return '0 Byte';
        var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
        return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
    }
    customFile.onchange = evt => {
        const [file] = customFile.files
        if (file) {
            $("#infoimage").removeClass("d-none").html('File Size: ' + bytesToSize(customFile.files[0].size))
        }
    }
    $("#gambar").on('submit', function(id) {
        id.preventDefault();
        var data = new FormData(this);
        $.LoadingOverlay("show");
        $.ajax({
            url: '{{route("user.foto")}}',
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
                    elem = '<div class="alert alert-danger alert-dismissible fade show pt-3" role="alert">';
                    elem += '   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span> </button><ul>';
                    result.forEach(function(data) {
                        elem += '<li>' + data[0][0] + '</li>';
                    });
                    elem += '</ul></div>';

                    $("#listnotif").html(elem);
                } else {
                    $("#gambar").trigger('reset');
                    $("#listnotif").html('');
                    alert('berhasil mengupdate foto profil')
                }
            }
        })


    })
    $("#password").on('submit', function(id) {
        id.preventDefault();
        var data = new FormData(this);
        $.LoadingOverlay("show");
        $.ajax({
            url: '{{route("user.password")}}',
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
                    elem = '<div class="alert alert-danger alert-dismissible fade show pt-3" role="alert">';
                    elem += '   <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span> </button><ul>';
                    result.forEach(function(data) {
                        elem += '<li>' + data[0][0] + '</li>';
                    });
                    elem += '</ul></div>';

                    $("#listnotif").html(elem);
                } else {
                    $("#password").trigger('reset');
                    $("#listnotif").html('');
                    alert('berhasil mengubah password')

                }
            }
        })


    })
</script>
@endpush