<div class="row">
    <div class="col-12 col-md-8 col-lg-9"></div>
    <div class="col-12 col-md-4 col-lg-3">

        <form action="" class="form-app">
            <div class="form-group-flex">
                <select class="form-select w-100"
                    id="selectStatus"
                    name="selectStatus"
                    aria-label="select type"
                    required>
                    @foreach ($statusPersonalFarms as $statusPersonalFarm)
                    <option value="{{$statusPersonalFarm}}">{{$statusPersonalFarm}}</option>
                    @endforeach
                </select>
                <div class="input-group">
                    <input type="search"
                        class="form-control bg-white"
                        id="searchFarm"
                        name="searchFarm"
                        placeholder="Nombre"
                        aria-describedby="button-addon2">
                    <button class="tg-input"
                        type="button"
                        id="-button"><i class="fas fa-fw fa-search"></i>
                    </button>
                </div>
            </div>
        </form>

    </div>

    <div id="personalStatistics" class="col-12 col-md-8 col-lg-9">
        ESTADISTICAS PERSONAL
    </div>
    <div id="personalContenForm" class="col-12 col-md-8 col-lg-9" style="display:none;">
        <form action="{{config('app.action-post-urls.update_personal_farm')}}" method="put" id="form_update_personal_farm" class="form-dashboard card border-0 shadow-none bg-transparent">
            @csrf
            <div class="card-body pr-xl-5">
                <div class="row  mb-3">
                    <h2 id="tName" class="title-blue text-bold col-12"></h2>
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
                        <a href="{{url('dashboard/finca/personal/'.$data[0]->id_Finca)}}" class="mx-sm-3 my-1 my-sm-0 btn btn-secundary">Cancelar</a>
                        <button type="submit" id="fincaPersonalSave" class="action mx-sm-3 my-1 my-sm-0 btn btn-primary btn-primary-darck">Guardar<br>Cambios</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <div class="col-12 col-md-4 col-lg-3 list-group-ulcontainer">
        
        <ul id="listPersonal" class="list-group list-group-flush">
            <!--li-- class="list-group-item">
                <div class="row continer-item-list ">
                    <div class="col-6 iconpersonalfarm text-center">
                        <h4 class="mb-1">Nombre</h4>
                    </div>
                    <div class="col-6">
                    <button type="button" id="listItem" class="btn btn-secundary btn-secundary-darck float-right listItem">Ver Personal</button>
                    </div>
                </div>
            </!--li-->
        </ul>

    </div>
</div>
