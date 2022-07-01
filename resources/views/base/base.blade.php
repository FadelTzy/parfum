<!DOCTYPE html>
<html lang="en">
<!-- Mirrored from dore-jquery.coloredstrategies.com/Blank.Page.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 02 Nov 2021 19:07:59 GMT -->

<head>
    <meta charset="UTF-8">
    <title>Safari Parfum</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <!-- <link rel="stylesheet" href="font/iconsmind-s/css/iconsminds.css"> -->
    <link rel="stylesheet" href="{{asset('asset/font/simple-line-icons/css/simple-line-icons.css')}}">
    <link rel="stylesheet" href="{{asset('asset/css/vendor/bootstrap.min.css')}}">
    <!-- <link rel="stylesheet" href="css/vendor/bootstrap.rtl.only.min.css"> -->
    <link rel="stylesheet" href="{{asset('asset/css/vendor/component-custom-switch.min.css')}}">
    <link rel="stylesheet" href="{{asset('asset/css/vendor/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('asset/css/main.css')}}">
    @yield('admincss')
</head>

<body id="app-container" class="menu-default show-spinner">
    <nav class="navbar fixed-top">
        <div class="d-flex align-items-center navbar-left"><a href="#" class="menu-button d-none d-md-block"><svg class="main" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9 17">
                    <rect x="0.48" y="0.5" width="7" height="1" />
                    <rect x="0.48" y="7.5" width="7" height="1" />
                    <rect x="0.48" y="15.5" width="7" height="1" />
                </svg> <svg class="sub" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 18 17">
                    <rect x="1.56" y="0.5" width="16" height="1" />
                    <rect x="1.56" y="7.5" width="16" height="1" />
                    <rect x="1.56" y="15.5" width="16" height="1" />
                </svg> </a><a href="#" class="menu-button-mobile d-xs-block d-sm-block d-md-none"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 26 17">
                    <rect x="0.5" y="0.5" width="25" height="1" />
                    <rect x="0.5" y="7.5" width="25" height="1" />
                    <rect x="0.5" y="15.5" width="25" height="1" />
                </svg></a>
            <b>
                <h3>Safari Parfum</h3>
            </b>
        </div>
            <a class="navbar-logo" href="Dashboard.Default.html">
                <!-- <img class="logo d-none d-xs-block w-100"  src="{{asset('logo.png')}}" alt="">
                <img class="logo-mobile d-block d-xs-none" src="{{asset('logo.png')}}" alt=""> -->
            </a>
        <x-anavbar></x-anavbar>
    </nav>
    @yield('menu')
    <main>
        <div class="container-fluid">
            @yield('content')
        </div>
    </main>
    @yield('footer')
    <script>
    </script>
    <script src="{{asset('asset/js/vendor/jquery-3.3.1.min.js')}}"></script>
    <script src="{{asset('asset/js/vendor/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('asset/js/vendor/perfect-scrollbar.min.js')}}"></script>
    <!-- masih akan dihapus -->
    <script src="{{asset('asset/js/dore.script.js')}}"></script>
    <script src="{{asset('asset/js/scripts.js')}}"></script>
    @stack('adminjs')

</body>

</html>