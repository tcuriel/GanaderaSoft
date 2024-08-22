{{-- Navbar right links --}}
<ul class="navbar-nav ml-auto order-1 order-md-3 navbar-no-expand">

@if(isset(Auth::user()->name))
        <li class="nav-item dropdown">
            {{-- User menu toggler --}}
            <a href="#"
               class="nav-link dropdown-toggle bg-transparent"
               data-toggle="dropdown">
                <span @if(config('adminlte.usermenu_image')) class="d-none d-md-inline" @endif>
                    <img class="image rounded-circle" 
                         src="{{asset('/storage/images/'.Auth::user()->image)}}" 
                         alt="profile_image">   
                         <!-- style="width: 80px;height: 80px; padding: 10px; margin: 0px;" -->
                    <span>{{ Auth::user()->name }}</span>
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end bg-transparent" 
                 aria-labelledby="navbarDropdown">
                <a class="btn btn-default btn-flat bg-transparent"
                   href="#" 
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-fw fa-power-off text-red"></i>
                    {{ __('adminlte::adminlte.log_out') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="navbar-brand ">
                    @csrf
                </form>
            </div>
        </li>
    @endif
</ul>

