<!-- Main Sidebar Container -->
<div class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: transparent;">
    <!-- Sidebar -->
    <div class="sidebar" style="background-color: transparent;">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Subir usuarios
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('seleccionarSubirUsuarios')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Subir</p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-alt"></i>
              <p>
                Usuarios
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('crudusuarios.option.list', ['opcion' => 'mixto', 'archivado' => 0])}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>CRUD</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('users.option.list', ['opcion' => 'mixto', 'archivado' => 0])}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Mixto</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('users.option.list', ['opcion' => 'propietario', 'archivado' => 0])}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Propietario</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('users.option.list', ['opcion' => 'transcriptor', 'archivado' => 0])}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Transcriptor</p>
                </a>
              </li>
              <!--li class="nav-item">
                <a href="{{route('crearusuario')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Crear</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index2.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Modificar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Consultar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Eliminar</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../index3.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Archivar</p>
                </a>
              </li-->
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class='nav-icon fas fa-table' style='color:red'></i>
              <span class="nav-text">Tablas generales</span>
              <i class="right fas fa-angle-left"></i>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ '#' }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Composicion Raza</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ '#' }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Día Palpación</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ '#' }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Estado Salud</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ '#' }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Etapas</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ '#' }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Explotación</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ '#' }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Folículo</p>
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ '#' }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Involución Uterina</p> 
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ '#' }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Patología</p> 
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ '#' }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Tipo Animal</p> 
                </a>
              </li>
            </ul>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ '#' }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Vacuna</p> 
                </a>
              </li>
            </ul>

          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
      </div>
    <!-- /.sidebar -->

</div>