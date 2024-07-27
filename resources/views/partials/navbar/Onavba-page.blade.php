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

            <li class="nav-item dropdown user-menu">
                {{-- User menu toggler --}}
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    @if(config('adminlte.usermenu_image'))
                        <img src="{{ Auth::user()->adminlte_image() }}"
                            class="user-image img-circle elevation-2"
                            alt="{{ Auth::user()->name }}">
                    @endif
                    <span @if(config('adminlte.usermenu_image')) class="d-none d-md-inline" @endif>
                        {{ Auth::user()->name }}
                    </span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <li class="user-footer">
                        <a class="btn btn-default btn-flat float-right btn-block"
                        href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-fw fa-power-off text-red"></i>
                            {{ __('adminlte::adminlte.log_out') }}
                        </a>
                        <form id="logout-form" action="{{ $logout_url }}" method="POST" style="display: none;">
                            @if(config('adminlte.logout_method'))
                                {{ method_field(config('adminlte.logout_method')) }}
                            @endif
                            {{ csrf_field() }}
                        </form>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>
