@extends('adminlte::page')

@section('adminlte_css')
    @vite(['resources/sass/app.scss'])
    @vite(['resources/sass/app/ganadegasof.scss'])
    @vite(['resources/sass/app/home/homestyle.scss'])
    @if($section == "finca")
        @vite(['resources/sass/app/finca/homefincapersonal.scss'])
    @endif
@stop

@section('title', env('APP_NAME', 'GanaderoSoft'))

@section('content')
    <div class="row">
        <div class="col-6 d-flex justify-content-start"></div>
        <div class="col-6 d-flex justify-content-end"><a href="/dashboard/finca/inventario/{{ $data[0]->id_Finca }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar</a></div>
    </div>
    <div class="row">
        <form action="{{config('app.action-post-urls.add_inventario_farm')}}" method="post" id="form_add_inventario_farm" class="form-dashboard card border-0 shadow-none bg-transparent">
            @csrf
            <div class="card-body pr-xl-5">
                <div class="row  mb-3">
                    <h2 id="tName" class="text-bold text-center col-12">Añadir Inventario</h2>
                    <h3 class="text-center col-12">¿Qué tipo de Inventario desea contabilizar?</h3>
                    <p>Solo puede seleccionar un Tipo de Inventario</p>
                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                        @foreach ($inventories as $clave => $valor)
                            @if($clave == 'general')
                                <input type="radio" class="btn-check" name="radioinventario" id="{{$clave}}" value="{{$clave}}" checked>
                            @else
                                <input type="radio" class="btn-check" name="radioinventario" id="{{$clave}}" value="{{$clave}}">
                            @endif
                            <label class="btn btn-outline-primary mx-1" for="{{$clave}}">{{$valor}}</label>
                        @endforeach
                    </div>
                    <span id="inventario-error" class="invalid-feedback font-weight-bold" role="alert"></span>
                </div>
            </div>
            <div class="card-footer bg-transparent">
                <div class="row">
                    <div class="col-md-7 d-flex flex-wrap justify-content-center justify-content-md-end">
                        <a href="/dashboard/finca/inventario/{{ $data[0]->id_Finca }}" class="action mx-sm-3 my-1 my-sm-0 btn btn-secundary">Atrás</a>
                        <button type="submit" id="fincaInventarioSave" class="action mx-sm-3 my-1 my-sm-0 btn btn-clear">Contabilizar</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@stop
@section('js')
    <script>
        let navItems = document.querySelectorAll('.nav-pills .nav-link');
        let sectionName = "{{$section}}";
        let viewName = "{{$selectView}}";
        let navItem = document.getElementById(sectionName + 'Section');
        if (navItem) {
            const navLink = navItem.querySelector('.nav-link');
            navLink.classList.add('active');
        }
        for (const navItem of navItems) {
            const href = navItem.getAttribute('href');
            navItem.setAttribute('href', href + "/{{ $data[0]->id_Finca }}" );
        }
        window.dataFinca = '{!! json_encode($data) !!}';
    </script>
    @vite(['resources/js/finca/inventario.js'])
@stop
