<div class="menu">
    <div class="main-menu">
        <div class="scroll">
            <ul class="list-unstyled">
                <li class="{{ Request::is('mahasiswa') ? 'active' : '' }}"><a href="{{route('mahasiswa.dashboard')}}"><i class="simple-icon-screen-desktop"></i> <span>Dashboard</span></a></li>
                <li class="{{ Request::is('mahasiswa/profile') ? 'active' : '' }}"><a href="{{route('mahasiswa.profil')}}"><i class="simple-icon-people"></i> Profile</a></li>
                <li class="{{ Request::is('mahasiswa/konsultasi') ? 'active' : '' }}"><a href="{{route('mhs.konsul')}}"><i class="simple-icon-doc"></i> Konsultasi</a></li>
                <li class="{{ Request::is('mahasiswa/rekap-konsultasi') ? 'active' : '' }}"><a href="{{route('mhs.rekap')}}"><i class="simple-icon-doc"></i> Rekap</a></li>
                <li class="{{ Request::is('mahasiswa/laporan-sks') ? 'active' : '' }}"><a href="{{route('mhs.sks')}}"><i class="simple-icon-notebook"></i> Laporan SKS </a></li>
                <li class="{{ Request::is('mahasiswa/laporan-perkembangan-sks') ? 'active' : '' }} text-center"><a href="{{route('mhs.grafik')}}"><i class="simple-icon-notebook"></i> Grafik Perkembangan </a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <a href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                            <i class="simple-icon-power"></i>

                            {{ __('Logout') }}
                        </a>
                    </form>

                </li>

            </ul>
        </div>
    </div>
    <!--<div class="sub-menu">-->
    <!--    <div class="scroll">-->


    <!--        <ul class="list-unstyled" data-link="konsul" id="konsul">-->
    <!--            <li><a href="{{route('mhs.konsul')}}"><i class="simple-icon-user"></i> <span class="d-inline-block">Mulai Konsultasi</span></a></li>-->
    <!--            <li><a href="{{route('mhs.rekap')}}"><i class="simple-icon-user"></i> <span class="d-inline-block">Rekap Konsultasi</span></a></li>-->
    <!--        </ul>-->
    <!--        <ul class="list-unstyled" data-link="jadwal" id="jadwal">-->
    <!--            <li><a href="{{route('mhs.sks')}}"><i class="simple-icon-user"></i> <span class="d-inline-block">Laporan SKS</span></a></li>-->
    <!--            <li><a href="{{route('mhs.grafik')}}"><i class="simple-icon-user"></i> <span class="d-inline-block">Grafik Perkembangan SKS</span></a></li>-->
    <!--        </ul>-->


    <!--    </div>-->
    <!--</div>-->
</div>