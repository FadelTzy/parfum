@extends('base.base')

@section('admincss')

@yield('pagecss')
@endsection

@section('menu')
<x-amenu></x-amenu>
@endsection
@section('content')
@yield('contentpage')
@endsection
@section('appmenu')
@yield('appmenu')
@endsection
@section('footer')
<x-footer></x-footer>

@endsection
@push('adminjs')
@stack('pagejs')
@endpush