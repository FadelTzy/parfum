@extends('admin.index')

@section('pagecss')
    <link rel="stylesheet" href="{{ asset('asset/css/vendor/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('asset/css/vendor/datatables.responsive.bootstrap4.min.css') }}">
@endsection


@section('contentpage')
    <div class="row">
        <div class="col-12">
            <h1> Dashboard</h1>



            <nav class="breadcrumb-container d-none d-sm-block d-lg-inline-block" aria-label="breadcrumb">
                <ol class="breadcrumb pt-0">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                </ol>
            </nav>
            <div class="separator mb-5"></div>
        </div>
    </div>
    <div class="row">
        <div class="col-8">
            <div class="mb-1 card">
                <div class="card-body">
                    <div class="">
                        <h1 class="display-4">Selamat Datang,</h1>
                        <p class="lead">Safari Parfum.</p>                  
                    </div>
                </div>
            </div>
        </div>
        <div class="col-4">
            <div class="card mb-4 progress-banner">
                <div class="card-body justify-content-between d-flex flex-row align-items-center">
                    <div><i class="simple-icon-wallet mr-2 text-white align-text-bottom d-inline-block"></i>
                        <div>
                            <p class="lead text-white">Pendapatan</p>
                            <p class="text-small text-white" id="disiniharga">{{$duit}}</p>
                        </div>
                    </div>
                    <div>
                        <div><h5 class="text-white" id="disinidates">{{$today}}</h5></div>
                        <button class="btn btn-outline-white btn-xs dropdown-toggle" type="button" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" id="statusLaporan">Hari ini</button>
                        <div class="dropdown-menu">
                            <a class="dropdown-item" onclick="getDuit(1)" href="#">Hari Ini</a>
                            <a class="dropdown-item" onclick="getDuit(2)" href="#">Minggu Ini</a>
                            <a class="dropdown-item" onclick="getDuit(3)" href="#">Bulan Ini</a>
                            <a class="dropdown-item" onclick="getDuit(4)" href="#">Tahun Ini</a>
                        </div>
                    </div>
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
        function getDuit(id) {
            if (id == 1) {
                $("#statusLaporan").html("Hari ini");
            }
            if (id == 2) {
                $("#statusLaporan").html("Minggu ini");
            }
            if (id == 3) {
                $("#statusLaporan").html("Bulan ini");
            }
            if (id == 4) {
                $("#statusLaporan").html("Tahun ini");
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            url = window.location.origin;
            console.log(id);
            $.LoadingOverlay("show");
            $.ajax({
                url: '{{ route('admin.getduit') }}',
                data: {
                    tipe:id
                },
                processData: true,

                type: "POST",
                success: function(id) {
                    console.log(id);
                    $.LoadingOverlay("hide");

                    if (id.status == 'error') {
                    
                    } else {
                        $("#disiniharga").html(id.duit)
                        $("#disinidates").html(id.dates);
               


                    }
                }
            })
        }
    </script>
@endpush
