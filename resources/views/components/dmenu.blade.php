<div class="menu">
    <div class="main-menu">
        <div class="scroll">
            <ul class="list-unstyled">
                <li class="{{ Request::is('dosen') ? 'active' : '' }}"><a href="{{route('dosen.dashboard')}}"><i class="simple-icon-screen-desktop"></i> <span>Dashboard</span></a></li>
                <li class="{{ Request::is('dosen/profile') ? 'active' : '' }}"><a href="{{route('dosen.profil')}}"><i class="simple-icon-people"></i> <span >Informasi Dosen</span></a></li>
                <li class="{{ Request::is('dosen/mahasiswa-bimbingan') ? 'active' : '' }}"><a href="{{route('dosen.bimbingan')}}"><i class="simple-icon-people"></i> <span >Mahasiwa Bimbingan</span></a></li>            
                <li class="{{ Request::is('dosen/konsultasi-bimbingan') ? 'active' : '' }}"><a href="{{route('dosen.kb')}}"><i class="simple-icon-doc"></i> <span >Konsultasi Bimbingan</span></a></li>
                <li class="{{ Request::is('dosen/rekap-konsultasi') ? 'active' : '' }}"><a href="{{route('dosen.rekap')}}"><i class="simple-icon-doc"></i> <span >Rekap Konsultasi</span></a></li>
                <li class="text-center"><a href="{{route('dosen.laporan')}}"><i class="simple-icon-notebook"></i> Laporan Akademik </a></li>
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
    <div class="sub-menu">
        <div class="scroll">

            <ul class="list-unstyled" data-link="layouts" id="layouts">
                <li><a href="{{route('dosen.profil')}}"><i class="simple-icon-user"></i> <span class="d-inline-block">Informasi Dosen</span></a></li>
                <li><a href="{{route('dosen.bimbingan')}}"><i class="simple-icon-user"></i> <span class="d-inline-block">Mahasiwa Bimbingan</span></a></li>


            </ul>
            <ul class="list-unstyled" data-link="konsul" id="konsul">
                <li><a href="{{route('dosen.kb')}}"><i class="simple-icon-user"></i> <span class="d-inline-block">Konsultasi Bimbingan</span></a></li>
                <li><a href="{{route('dosen.rekap')}}"><i class="simple-icon-user"></i> <span class="d-inline-block">Rekap Konsultasi</span></a></li>
            </ul>



        </div>
    </div>
</div>