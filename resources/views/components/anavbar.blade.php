<div class="navbar-right">
    <div class="header-icons d-inline-block align-middle">
        <div class="d-none d-md-inline-block align-text-bottom mr-3">
            <div class="custom-switch custom-switch-primary-inverse custom-switch-small pl-1" data-toggle="tooltip" data-placement="left" title="Dark Mode"><input class="custom-switch-input" id="switchDark" type="checkbox" checked="checked"> <label class="custom-switch-btn" for="switchDark"></label></div>
        </div>
        @if(Auth::user()->role == 1)
        @elseif(Auth::user()->role == 0)
        @else
      
        @endif
        <button class="header-icon btn btn-empty d-none d-sm-inline-block" type="button" id="fullScreenButton"><i class="simple-icon-size-fullscreen"></i> <i class="simple-icon-size-actual"></i></button>
    </div>
    <div class="user d-inline-block"><button class="btn btn-empty p-0" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="name">{{Auth::user()->name}}</span> <span><img alt="Profile Picture" src="{{asset('image/fotomhs/')}}/{{Auth::user()->foto ?? 'none.jpg'}}"></span></button>
        <div class="dropdown-menu dropdown-menu-right mt-3">
            @if(Auth::user()->role == 3)
            <a class="dropdown-item" href="{{url('mahasiswa/profile')}}">Profle</a>
            @elseif(Auth::user()->role == 2)
            <a class="dropdown-item" href="{{url('dosen/profile')}}">Profle</a>
            <a class="dropdown-item" href="{{url('dosen/mahasiswa-bimbingan')}}">Bimbingan</a>
            @endif
            <div class="dropdown-item ">
                <form method="POST" class="d-block" action="{{ route('logout') }}">
                    @csrf

                    <a href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">

                        {{ __('Logout') }}
                    </a>
                </form>
            </div>
        </div>
    </div>
</div>