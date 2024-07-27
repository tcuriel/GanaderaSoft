@extends('adminlte::page')

@section('adminlte_css')
    @vite(['resources/sass/app.scss'])
    @vite(['resources/sass/app/ganadegasof.scss'])
    @vite(['resources/sass/app/home/homestyle.scss'])
    @if($section == "finca")
        @vite(['resources/sass/app/finca/homefinca.scss'])
    @endif
@stop

@section('title', env('APP_NAME', 'GanaderoSoft'))

@section('content')

<div class="row">
    <div class="col-6 d-flex justify-content-start"></div>
    <div class="col-6 d-flex justify-content-end"><a href="/dashboard/finca/rebano/{{ $data[0]->id_Finca }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar</a></div>
</div>
<div class="row">
    <form action="{{config('app.action-post-urls.add_renbano_farm')}}" method="post" id="form_add_renbano_farm" class="form-dashboard card border-0 shadow-none bg-transparent">
        @csrf
        <div class="card-body pr-xl-5 step">
            <div class="row">
                <div class="col-12">
                    <h2 class="text-center">Nuevo Rebaño</h2>
                </div>
                <div class="col-md-6 p-col-form">
                    <div class="form-container-inputs">
                        <label type="text"
                            for="name"
                            class="form-label"><span>(*)</span> Nombre del Rebaño</label>
                        <input type="text"
                            class="form-control"
                            id="name"
                            name="name"
                            placeholder="Rebaño"
                            required>
                        <span id="name-error" class="invalid-feedback font-weight-bold" role="alert"></span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex flex-wrap justify-content-center">
                    <button type="button" class="submit btn btn-secundary btn-secundary-darck">Agregar</button>
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
    @vite(['resources/js/finca/rebano.js'])
@stop
