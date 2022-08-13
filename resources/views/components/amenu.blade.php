<div class="menu">
    <div class="main-menu">
        <div class="scroll">
            <ul class="list-unstyled">
                <li class="{{ Request::is('admin') ? 'active' : '' }}"><a href="{{ route('admin.dashboard') }}"><i
                            class="simple-icon-screen-desktop"></i> <span>Dashboard</span></a></li>
                <li class=""><a href="{{ route('customer.index') }}"><i class="simple-icon-people"></i> Costumer</a>
                </li>
                <li><a href="#layouts"><i class="simple-icon-menu"></i> Data Master</a></li>
                <li class="{{ Request::segment(2) == 'transaksi' ? 'active' : '' }}"><a
                        href="{{ route('admin.transak') }}"><i class="simple-icon-basket"></i> Transaksi</a>
                </li>
                <li class="{{ Request::segment(2) == 'riwayat-transaksi' ? 'active' : '' }}"><a
                        href="{{ route('admin.riwayat') }}"><i class="simple-icon-basket"></i> Riwayat Transaksi</a>
                </li>
                <li class=""><a href="{{ route('admin.profil') }}"><i class="simple-icon-user"></i> Profile</a>
                </li>
                <li class=""><a href="{{ route('admin.profil') }}"><i class="simple-icon-settings"></i>
                        Pengaturan</a>
                </li>


                <li><a href="#layouts"><i class="simple-icon-people"></i> Data Master</a></li>
                <li class=""><a href="{{ route('admin.profil') }}"><i class="simple-icon-user"></i> Profile</a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <a href="route('logout')"
                            onclick="event.preventDefault();
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
                <li><a href="{{ route('data.admin') }}"><i class="simple-icon-user"></i> <span
                            class="d-inline-block">Data Admin</span></a></li>
                <li><a href="{{ route('barang.index') }}"><i class="simple-icon-user"></i> <span
                            class="d-inline-block">Data Produk</span></a></li>
                <li><a href="{{ route('setting.index') }}"><i class="simple-icon-user"></i> <span
                            class="d-inline-block">konfigurasi Nota</span></a></li>
            </ul>


        </div>
    </div>
</div>
