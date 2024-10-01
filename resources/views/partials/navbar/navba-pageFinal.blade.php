    {{-- Navbar Top --}}
    <nav class="main-header navbar navbar-expand"  style="display: flex;align-items: flex-start;">

      <ul class="navbar-nav ml-auto">
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
                          style="background-color: #D9D9D9;width: 80px;height: 80px; padding: 10px; margin: 0px;">   
                          <!-- style="width: 80px;height: 80px; padding: 10px; margin: 0px;" 
                               style="background-color: #D9D9D9;"
                               style="background-color: gray;margin-top: 0;"-->
                      <span style="color: #fff;">{{ Auth::user()->name }}</span>
                  </span>
              </a>
              {{-- --}}
              <div class="dropdown-menu dropdown-menu-end" 
                   aria-labelledby="navbarDropdown">
                <!-- class="btn btn-default btn-flat" -->
                <a class="btn btn-default btn-flat"
                   style="min-width: 50px;max-width: 100px;padding: 10px;"
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
    </nav>
    {{-- --}}