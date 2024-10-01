<aside class="main-sidebar sidebar-blue-primary">
      <a href="http://ganaderasoft.com/home" class="brand-link" style="display: inline-block;width: 100px;height: 100px;">
        <img src="{{ asset('images/logo-vaca-1-1.png')  }}" 
             alt="" 
             class="brand-image img-circle elevation-3" 
             style="position: relative;z-index: 1;width: 100px;height: 100px;max-height: 100px;">

      </a>

      <div class="label"><div class="text-wrapper">GanaderaSoft</div></div>

      <div class="sidebar">
      
        <nav class="pt-2 opciones">
    
          <ul class="nav nav-pills nav-sidebar flex-column " data-widget="treeview" role="menu">

            <li  id="fincaSection"  class="nav-item">
              <a class="nav-link "href="{{ url('/dashboard/finca/finca') }}">
                <i class="ico ico_farm "></i>
                <p>
                  Finca
                </p>
              </a>
            </li>

            <li  id="animalSection"  class="nav-item">
              <a class="nav-link "href="{{ url('/dashboard/animal/animal') }}">
              <i class="ico ico_cow "></i>
                <p>
                  Animal
                </p>
              </a>
            </li>

            <li  id="produccionSection"  class="nav-item">
              <a class="nav-link "href="{{ url('/dashboard/produccion/produccion') }}">
                <i class="ico ico_reproduction "></i>
                <p>
                  Producción
                </p>
              </a>
            </li>

            <li  id="reproduccionSection"  class="nav-item">
              <a class="nav-link "href="{{ url('/dashboard/reproduccion/reproduccion') }}">
                <i class="ico ico_production "></i>
                <p>
                  Reproducción
                </p>
              </a>
            </li>

            <li  id="sanidadSection"  class="nav-item">
              <a class="nav-link "href="{{ url('/dashboard/sanidad/sanidad') }}">
                <i class="ico ico_health "></i>
                <p>
                  Sanidad
                </p>
              </a>
            </li>
            
            <li  id="reporteSection"  class="nav-item">
              <a class="nav-link  "href="{{ url('/dashboard/reporte/reporte') }}">
                <i class="ico ico_notes "></i>
                <p>
                  Reporte
                </p>
              </a>
            </li>
            
          </ul>
          
        </nav>
        
      </div>
      
    </aside>