@extends('layouts.page2')

@php
    $cargar_tabs = true;
    $mostrar_instituciones = false;
    $mostrar_estrella_solitaria = true;
    $mostrar_lateral = false;
    $mostrar_btn_inicio_sesion = false;
@endphp

@section('classes_body')
    row
    g-0
    min-vh-100
@endsection

@section('css-content')

  <link rel="stylesheet" href=" {{ asset('assets/css/upload.css') }}">

    <style>
      .dropZone {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 90%;
        height: 15vh;
        border: 1px solid #5AB0D180;
		    border-radius: 10px;
      }

      .p_interno{
        font-size: 18px;
        animation: sombraTexto 1s infinite;
      }

      .dropZone.is-active {
        border: 2px dashed #fff;
        background-color: #02ff0280;
        animation: contenidoInterno 1.5s infinite;
        animation-timing-function: linear;
      }

    </style>
    
    <style type="text/css">

				/* Curso CSS estilos aprenderaprogramar.com*/
				body {
          font-family: Arial, Helvetica, sans-serif;
        }

				table {     
          font-family: "Lucida Sans Unicode", "Lucida Grande", Sans-Serif;
					font-size: 16px;    
          margin: 45px;     
          width: 80%; 
          /*height: 100vh;*/
          text-align: left;    
          border-collapse: collapse; 
        }

				th {     
          font-size: 18px;     
          font-weight: normal;     
          padding: 8px;     
          background: #5AB0D1;
					border-top: 4px solid #aabcfe;    
          border-bottom: 1px solid #fff; 
          color: #000; 
        }

				td {    
          padding: 8px;     
          background: #e8edff;     
          border-bottom: 1px solid #fff;
					color: #000;    
          border-top: 1px solid transparent; 
        }

				tr:hover td { 
          background: #d0dafd; 
          color: #339; 
        }
      </style>

@endsection

@section('instituciones')
        <img src="{{ asset('images/ucv 1.svg') }}" alt="">
        <img src="{{ asset('images/logonuevopng (1) 1.svg') }}" alt="">
        <img src="{{ asset('images/fagro.svg') }}" alt="">
        <img src="{{ asset('images/Fonacit 1.svg') }}" alt="">
@endsection

@section('barra2')

    <div class="nav2-container">
        {{-- Tabs --}}
        <div class="item nav2-tabs-container">
            <h2>Administrar Sistema GanaderaSoft</h2>

        </div>

        {{-- Botón (Inicio de Sesión) --}}
        <div class="item nav2-btn-container">
            @if($mostrar_btn_inicio_sesion)
                <a href="{{ route('login') }}"
                    type="button"
                    class="btn btn-clear2 btn-230 btn-lg"
                    style="justify-content: right;align-items: right;">
                    Inicio de Sesión
                </a>
            @endif
        </div>

    </div>

@endsection

@section('barra3')

@endsection

@section('lateral')

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4" style="background-color: transparent;">
    <!-- Sidebar -->
    <div class="sidebar" style="background-color: transparent;">
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
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
              </li>
            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-users"></i>
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

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
      </div>
    <!-- /.sidebar -->
  </aside>

@endsection

@section('contenido')

<div id="conteudos" class="conteudos">

    <div class="conteudos_tabs">

        <ul id="abas" class="teste">

            @if($cargar_tabs)
                <li class="selecionada">
                    <a id="aba_1" href="#aba_1" onclick="event.preventDefault()">
                    </a>
                </li>
                <li>
                    <a id="aba_2" href="#aba_2" onclick="event.preventDefault()">
                    </a>
                </li>
            @endif
            
        </ul>

    </div>

		<!--h2 style="width: 60rem;left: 20px;"><--- Subir Usuarios</h2-->

		<div id="conteudo_1" class="conteudo visivel">

      <div class="card card-primary">
        <div class="card-header" style="background-color: #5AB0D1;">
          <h3 class="card-title">Subir Usuarios</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="" method="post">
          <div class="card-body">
            <p style="text-align: right;"><span class="text-danger">(*)</span>{{ __('adminlte::adminlte.required_camp') }}</p>

            <div class="form-group row">
              <label for="InputFile" class="col-sm-2 col-form-label"><span class="text-danger">(*)</span>Archivo</label>
              <div class="col-sm-10">
                <!--input type="file" class="form-control-file upload-btn" id="InputFile"-->
                <input type = "file" name="InputFile" class = "visually-hidden" id = "InputFile">
                <button type = "button" class = "btn btn-secundary upload-btn">Seleccionar Archivos</button>    
              </div>
            </div>

            <div class="form-group row">
              <label for="archivo" class="col-sm-2 col-form-label"></label>
              <div class="col-sm-10">
                <article class="dropZone">

                  <!--div class = "upload-img">
                      <img src = "images/upload.png" alt = "" id="blah">
                  </div-->
                  <!--p class="p_interno">Arrastre y suelte el archivo aquí</p-->
                  <p class = "upload-text">Arrastre y suelte el archivo aquí</p>

                </article>
              </div>
            </div>

            <div class="form-group row">
              <label for="separadorCSV" class="col-sm-2 col-form-label">Separación CSV</label>
              <div class="col-sm-1">
                <select id="separadorCSV" class="form-select">
                  <option>,</option>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="codificacion" class="col-sm-2 col-form-label">Codificación</label>
              <div class="col-sm-2">
                <select id="codificacion" class="form-select">
                  <option>UTF-8</option>
                </select>
              </div>
            </div>

            <div class="form-group row">
              <label for="previsualizarFilas" class="col-sm-2 col-form-label">Previsualizar filas</label>
              <div class="col-sm-1">
                <select id="previsualizarFilas" class="form-select">
                  <option>10</option>
                </select>
              </div>
            </div>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <button type="submit" class="btn btn-secundary2">Subir Usuarios</button>
          </div>
        </form>
      </div>
		</div>

		<div id="conteudo_2" class="conteudo">
      <p>Subida de fincas (previsualización)</p>
      <p>Conteúdo da Aba 2</p>
		</div>
		
	</div>
@endsection

@section('js-content')

	<script  src="{{ asset('assets/js/script-tabs.js') }}"></script>
  <script  src="{{ asset('assets/js/encoding.min.js') }}"></script>

  <script type="text/javascript">
			
      function parseCSV(text) {
        // Obtenemos las lineas del texto
        let lines = text.replace(/\r/g, '').split('\n');
        return lines.map(line => {
          // Por cada linea obtenemos los valores
          let values = line.split(',');
          return values;
        });
      }

      function reverseMatrix(matrix){
        let output = [];
        // Por cada fila
        matrix.forEach((values, row) => {
          // Vemos los valores y su posicion
          values.forEach((value, col) => {
            // Si la posición aún no fue creada
            if (output[col] === undefined) output[col] = [];
            output[row][col] = value;
            //Encoding.convert(value, 'ISO-8859-1', 'UTF-8');
          });
        });
        return output;
      }
      
      function readFile(evt) {
        let file = evt.target.files[0];
        let reader = new FileReader();

        reader.onload = (e) => {
          let data = e.target.result;
          let convertedData = Encoding.convert(data, 'ISO-8859-1', 'UTF-8'); // Ajusta las codificaciones
          let parsedData = reverseMatrix(parseCSV(data));
          
          console.log(parsedData);
          
          // Crear la tabla HTML
          let table = document.createElement('table');
          table.classList.add('csv-data');

          console.log(data[0]);
          
          // Crear la fila de encabezados
          let headerRow = document.createElement('tr');
          parsedData[0].forEach(header => {
            let headerCell = document.createElement('th');
            headerCell.textContent = header;
            headerRow.appendChild(headerCell);
          });
          table.appendChild(headerRow);  


          // Crear las filas de datos
          parsedData.slice(1).forEach(row => {
            let rowElement = document.createElement('tr');
            row.forEach(value => {
              let cell = document.createElement('td');
              cell.textContent = value;
              rowElement.appendChild(cell);
            });
            table.appendChild(rowElement);
          });

          // Mostrar la tabla en el contenedor
          document.getElementById('conteudo_2').appendChild(table);
        };
        reader.readAsText(file);
      }
      document.getElementById('InputFile').addEventListener('change', readFile, false);
      
    </script>
      
    <script>
        document.addEventListener("DOMContentLoaded", function() {
        const uploadContainer = document.querySelector('.dropZone');
        const uploadButton = document.querySelector('.upload-btn');
        const uploadInput = document.getElementById('InputFile');
        const uploadText = document.querySelector('.upload-text');
        const uploadImage = document.querySelector('.upload-img img');

        const handleFile = (file) => {
            const reader = new FileReader();
            reader.readAsDataURL(file);

            reader.onloadend = function() {
            uploadText.textContent = file.name;
            //uploadImage.setAttribute('aria-label', file.name);
            //uploadImage.setAttribute('src', reader.result);
            };
        };

        // Drag and Drop functionality
        uploadContainer.addEventListener('dragover', (event) => {
            event.preventDefault();
            uploadContainer.classList.add('dragover');
        });

        uploadContainer.addEventListener('dragleave', () => {
            uploadContainer.classList.remove('dragover');
        });

        uploadContainer.addEventListener('drop', (event) => {
            event.preventDefault();
            uploadContainer.classList.remove('dragover');
            handleFile(event.dataTransfer.files[0]);
            console.log(event.dataTransfer.files[0]);
        });

        uploadButton.addEventListener('click', function() {
            uploadInput.click();
        });

        // Click functionality
        uploadContainer.addEventListener('click', () => {
            uploadInput.click();
        });

        uploadInput.addEventListener('change', () => {
            handleFile(uploadInput.files[0]);
        });
        });
    </script>

@stop
