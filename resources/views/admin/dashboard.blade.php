@extends('admin.index')

@section('pagecss')
<link rel="stylesheet" href="{{asset('asset/css/vendor/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('asset/css/vendor/datatables.responsive.bootstrap4.min.css')}}">
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
    <div class="col-12">
        <div class="mb-1 card">
            <div class="card-body">
                <div class="">
                    <h1 class="display-4">Selamat Datang,</h1>
                    <p class="lead">Safari Parfum.</p>
                    <hr class="my-4">
                    <p class="mb-5">


                    </p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Magnam quibusdam deserunt sequi maiores voluptas sunt mollitia excepturi? Repellendus odio odit magni suscipit tempore, iste, labore, nulla ad cupiditate deserunt voluptas.</p>
                    <br>

                </div>
            </div>
        </div>
    </div>
   
</div>
@endsection

@push('pagejs')
<script src="{{asset('asset/js/vendor/datatables.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.7/dist/loadingoverlay.min.js
"></script>

@endpush