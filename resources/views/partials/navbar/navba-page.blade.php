<nav class="main-header navbar

    {{ config('adminlte.classes_topnav_nav', 'navbar-expand-md') }}
    {{ config('adminlte.classes_topnav', 'navbar-white navbar-light') }}">

    <div class="{{ config('adminlte.classes_topnav_container', 'container') }}">

        {{-- Navbar brand logo --}}
        @include('adminlte::partials.common.brand-logo-xs')

        @yield('welcome-user')

        {{-- Navbar toggler button --}}
        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse"
                aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        {{-- Navbar collapsible menu --}}
        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
            {{-- Navbar left links --}}
            <ul class="nav navbar-nav">
                {{-- Configured left links --}}
                <?php
                //<!--@each('adminlte::partials.navbar.menu-item', $adminlte->menu('navbar-left'), 'item')-->
                ?>
                {{-- Custom left links --}}
                @yield('content_top_nav_left')
            </ul>
        </div>
        {{-- Navbar right links --}}
        <ul class="navbar-nav ml-auto order-1 order-md-3 navbar-no-expand">

            @php( $logout_url = View::getSection('logout_url') ?? config('adminlte.logout_url', 'logout') )

            @if (config('adminlte.use_route_url', false))
                @php( $logout_url = $logout_url ? route($logout_url) : '' )
            @else
                @php( $logout_url = $logout_url ? url($logout_url) : '' )
            @endif

            @if(isset(Auth::user()->name))
                <li class="nav-item dropdown">
                    {{-- User menu toggler --}}
                    <a href="#"
                    class="nav-link dropdown-toggle bg-transparent"
                    data-toggle="dropdown">
                        <span @if(config('adminlte.usermenu_image')) class="d-none d-md-inline" @endif>
                            <img class="image rounded-circle" 
                                    src="{{asset('/storage/images/'.Auth::user()->image)}}" 
                                    alt="profile_image" 
                                    style="width: 80px;height: 80px; padding: 10px; margin: 0px;">
                            <span style="color: #000000;">{{ Auth::user()->name }}</span>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end bg-transparent" 
                        aria-labelledby="navbarDropdown">
                        <a class="btn btn-default btn-flat float-right btn-block"
                        href="#" 
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <br>
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
    </div>
</nav>
