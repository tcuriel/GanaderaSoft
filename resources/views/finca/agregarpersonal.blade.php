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
        <div class="col-6 d-flex justify-content-start"><h2>Nuevo Personal</h2></div>
        <div class="col-6 d-flex justify-content-end"><a href="/dashboard/finca/personal/{{ $data[0]->id_Finca }}"><i class="fa fa-arrow-left" aria-hidden="true"></i> Regresar</a></div>
    </div>
    <div class="row">
        <form action="{{config('app.action-post-urls.add_personal_farm')}}{{ $data[0]->id_Finca }}" method="post" id="form_add_personal_farm" class="form-dashboard card border-0 shadow-none bg-transparent">
            @csrf
            <div class="card-body pr-xl-5">
                <div class="row  mb-3">
                    <div class="col-md-4 p-col-form">
                        <label type="text"
                            for="idnumber"
                            class="form-label"><span>(*)</span> Numero de Identificación</label>
                        <i class="fa fa-info-circle fa-fw" aria-hidden="true" data-bs-placement="top" data-bs-toggle="popover" data-bs-content="Patron número de identificación nacional de Venezuela V-12345678-9"></i>
                        <input type="text"
                            class="form-control"
                            id="idnumber"
                            name="idnumber"
                            placeholder="Numero de Identificación">
                        <span id="idnumber-error" class="invalid-feedback font-weight-bold" role="alert"></span>
                    </div>
                    <div class="col-md-4 p-col-form">
                        <label type="text"
                            for="name"
                            class="form-label"><span>(*)</span> Nombre</label>
                        <input type="text"
                            class="form-control"
                            id="name"
                            name="name"
                            placeholder="Nombre"
                            data-pattern-input
                            data-pattern="^.{0,25}$"
                            >
                        <span id="name-error" class="invalid-feedback font-weight-bold" role="alert"></span>
                    </div>
                    <div class="col-md-4 p-col-form">
                        <label type="text"
                            for="lastname"
                            class="form-label"><span>(*)</span> Apellido</label>
                        <input type="text"
                            class="form-control"
                            id="lastname"
                            name="lastname"
                            placeholder="Apellido"
                            data-pattern-input
                            data-pattern="^.{0,25}$">
                        <span id="lastname-error" class="invalid-feedback font-weight-bold" role="alert"></span>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-md-4 p-col-form">
                        <label type="text"
                            for="phone"
                            class="form-label"><span>(*)</span> Teléfono</label>
                        <i class="fa fa-info-circle fa-fw" aria-hidden="true" data-bs-placement="top" data-bs-toggle="popover" data-bs-content="Debe poseer de 10 a 15 dígitos"></i>
                        <input type="text"
                            class="form-control"
                            id="phone"
                            name="phone"
                            placeholder="Teléfono"
                            data-pattern-input
                            data-pattern="^\d{0,15}?$">
                        <span id="phone-error" class="invalid-feedback font-weight-bold" role="alert"></span>
                    </div>
                    <div class="col-md-4 p-col-form">
                        <label type="text"
                            for="email"
                            class="form-label"><span>(*)</span> Correo</label>
                        <input type="text"
                            class="form-control"
                            id="email"
                            name="email"
                            placeholder="Correo">
                        <span id="email-error" class="invalid-feedback font-weight-bold" role="alert"></span>
                    </div>
                    <div class="col-md-4 p-col-form">
                        <label type="text"
                            for="worker"
                            class="form-label"><span>(*)</span> Tipo de Trabajador</label>
                        <i class="fa fa-info-circle fa-fw" aria-hidden="true" data-bs-placement="top" data-bs-toggle="popover" data-bs-content="Debe poseer 20 caracteres como máximo"></i>
                        <input type="text"
                            class="form-control"
                            id="worker"
                            name="worker"
                            placeholder="Tipo de Trabajador"
                            data-pattern-input
                            data-pattern="^.{0,20}$">
                        <span id="worker-error" class="invalid-feedback font-weight-bold" role="alert"></span>
                    </div>

                </div>
            </div>
            <div class="card-footer bg-transparent">
                <div class="row">
                    <div class="col-md-5">
                        <label class="form-label"><span class="text-danger">(*)</span>Estos Campos son Obligatorios</label>
                    </div>
                    <div class="col-md-7 d-flex flex-wrap justify-content-center justify-content-md-end">
                        <button type="submit" id="fincaPersonalSave" class="action mx-sm-3 my-1 my-sm-0 btn btn-secundary btn-180">Agregar</button>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    @vite(['resources/js/finca/personal.js'])
@stop
