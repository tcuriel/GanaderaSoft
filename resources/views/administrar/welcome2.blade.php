@extends('layouts.page2')

@php
    $cargar_tabs = false;
    $mostrar_instituciones = true;
    $mostrar_estrella_solitaria = true;
    $mostrar_lateral = true;
    $mostrar_btn_inicio_sesion = false;
@endphp

@section('classes_body')
    row
    g-0
    min-vh-100
@endsection

@section('css-content')

    @vite('resources/sass/app/wellcome/styles.scss')

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        .center-image-container {
        display: flex;
        justify-content: center;
        align-items: center;
        }
    </style>

@endsection

@section('instituciones')

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

@endsection

@section('contenido')

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ url()->previous() }}";
                }
            });
        </script>
    @endif

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

  <div id="conteudo_1" class="conteudo visivel">
    <div class="center-image-container">
        <img src="{{ asset('images/superusuarioXL.png') }}" alt="Super Usuario">
    </div>
  </div>

  <div id="conteudo_2" class="conteudo">

	</div>

</div>

@endsection

@section('js-content')
    <script>
            /*
            const  upload_input = document.getElementById('upload-input');

            document.querySelector('.upload-btn').addEventListener('click', function() {
                document.getElementById('upload-input').click();
            });

            upload_input.onchange = evt => {
                const [file] = upload_input.files;
                if (file) {
                    blah.src = URL.createObjectURL(file);
                }
            }
            */
            /*
            document.addEventListener("DOMContentLoaded", function() {
                const uploadContainer = document.querySelector('.upload-container');
                const uploadButton = document.querySelector('.upload-btn');
                const uploadInput = document.getElementById('image');
                const uploadText = document.querySelector('.upload-text');
                const uploadImage = document.querySelector('.upload-img img');

                uploadContainer.addEventListener('click', function() {
                    uploadInput.click();
                });

                uploadButton.addEventListener('click', function() {
                    uploadInput.click();
                });

                uploadInput.addEventListener('change', function(event) {
                    const file = event.target.files[0];
                    const reader = new FileReader();
                    reader.readAsDataURL(file);

                    reader.onloadend = function() {
                        uploadText.textContent = file.name;
                        uploadImage.setAttribute('aria-label', file.name);
                        uploadImage.setAttribute('src', reader.result);
                    };
                });
            });
            */
        </script>

        <!-- Bootstrap 4 -->
        <!--script src="{{-- asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js') --}}"></script-->
        <!-- AdminLTE App -->
        <!--script src="{{-- asset('assets/dist/js/adminlte.min.js') --}}"></script-->
        <!-- AdminLTE for demo purposes -->
        <!--script src="{{-- asset('assets/dist/js/demo.js') --}}"></script-->

@endsection
