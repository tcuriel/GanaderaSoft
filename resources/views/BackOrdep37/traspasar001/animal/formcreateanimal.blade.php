<form action="{{config('app.action-post-urls.create_animal').$data[0]->id_Finca}}/" method="post" id="form_create_animal" class="form-app card border-0 shadow-none bg-transparent">
    @csrf
    <div class="card-body pr-xl-5">
        <div class="row">
            <div class="col-12">
                <h2 class="title-blue form-title">INFORMACIÓN GENERAL ANIMAL</h2>
            </div>
            <div class="col-md-4 p-col-form">
                <label type="text"
                    for="name"
                    class="form-label"><span>(*)</span> Nombre</label>
                    <i class="fa fa-info-circle fa-fw" aria-hidden="true" data-bs-placement="top" data-bs-toggle="popover" data-bs-content="Debe poseer 25 caracteres como máximo"></i>
                <input type="text"
                    class="form-control"
                    id="name"
                    name="name"
                    placeholder="Nombre"
                    data-numbers-only
                    data-pattern-input
                    data-pattern="^.{0,25}$">
                <span id="name-error" class="invalid-feedback font-weight-bold" role="alert"></span>
            </div>
            <div class="col-md-4 p-col-form">
                <label type="text"
                    for="sex"
                    class="form-label"><span>(*)</span> Sexo</label>
                <select class="form-select w-100"
                    id="sex"
                    name="sex"
                    aria-label="select type sex"
                    required>
                    <option hidden value="" class="placeholder-style">Sexo</option>
                    @foreach ($animalSexo as $clave => $valor)
                    <option value="{{$clave}}">{{$valor}}</option>
                    @endforeach
                </select>
                <span id="sex-error" class="invalid-feedback font-weight-bold" role="alert"></span>
            </div>
            <div class="col-md-4 p-col-form">
                <label type="text"
                    for="age"
                    class="form-label"><span>(*)</span> Edad</label>
                    <i class="fa fa-info-circle fa-fw" aria-hidden="true" data-bs-placement="top" data-bs-toggle="popover" data-bs-content="Debe indicar edad en numero de meses"></i>
                <input type="text"
                    class="form-control"
                    id="age"
                    name="age"
                    placeholder="Edad"
                    data-numbers-only
                    data-pattern-input
                    data-pattern="^(\d{1,2})$">
                <span id="age-error" class="invalid-feedback font-weight-bold" role="alert"></span>
            </div>

            <div class="col-md-4 p-col-form">
                <label type="text"
                    for="type"
                    class="form-label"><span>(*)</span> Tipo</label>
                <select class="form-select w-100"
                    id="type"
                    name="type"
                    aria-label="select type type"
                    required>
                    <option hidden value="" class="placeholder-style">Tipo</option>
                    @foreach ($animalType as $clave => $valor)
                    <option value="{{$clave}}">{{$valor}}</option>
                    @endforeach
                </select>
                <span id="type-error" class="invalid-feedback font-weight-bold" role="alert"></span>
            </div>

            <div class="col-md-4 p-col-form">
                <label type="text"
                    for="stage"
                    class="form-label"><span>(*)</span> Etapa</label>
                <select class="form-select w-100"
                    id="stage"
                    name="stage"
                    aria-label="select stage stage"
                    required>
                    <option hidden value="" class="placeholder-style">Tipo</option>
                    @foreach ($animalStage as $clave => $valor)
                    <option value="{{$clave}}">{{$valor}}</option>
                    @endforeach
                </select>
                <span id="type-error" class="invalid-feedback font-weight-bold" role="alert"></span>
            </div>

            <div class="col-md-4 p-col-form">
                <label type="text"
                    for="state"
                    class="form-label"><span>(*)</span> Estado</label>
                <select class="form-select w-100"
                    id="state"
                    name="state"
                    aria-label="select state type"
                    required>
                    <option hidden value="" class="placeholder-style">Estado</option>
                    @foreach ($animalState as $clave => $valor)
                    <option value="{{$clave}}">{{$valor}}</option>
                    @endforeach
                </select>
                <span id="state-error" class="invalid-feedback font-weight-bold" role="alert"></span>
            </div>

            <div class="col-md-4 p-col-form">
                <label type="text"
                    for="origin"
                    class="form-label"><span>(*)</span> Procedencia</label>
                    <i class="fa fa-info-circle fa-fw" aria-hidden="true" data-bs-placement="top" data-bs-toggle="popover" data-bs-content="Debe poseer 50 caracteres como máximo"></i>
                <input type="text"
                    class="form-control"
                    id="origin"
                    name="origin"
                    placeholder="Procedencia"
                    data-numbers-only
                    data-pattern-input
                    data-pattern="^.{0,50}$">
                <span id="origin-error" class="invalid-feedback font-weight-bold" role="alert"></span>
            </div>

            <div class="col-md-4 p-col-form">
                <label type="text"
                    for="herd"
                    class="form-label"><span>(*)</span> Rebaño</label>
                <select class="form-select w-100"
                    id="herd"
                    name="herd"
                    aria-label="select herd type"
                    required>
                    <option hidden value="" class="placeholder-style">Rebaño</option>
                    @foreach ($listRebano as $clave => $valor)
                    <option value="{{$valor->id_Rebano}}">{{$valor->Nombre}}</option>
                    @endforeach
                </select>
                <span id="herd-error" class="invalid-feedback font-weight-bold" role="alert"></span>
            </div>

        </div>
    </div>
    <div class="card-footer bg-transparent">
        <div class="row">
            <div class="col-md-5">
                <label class="form-label"><span class="text-danger">(*)</span>Estos Campos son Obligatorios</label>
            </div>
            <div class="col-md-7 d-flex flex-wrap justify-content-center justify-content-md-end">
                <button type="button" class="action back mx-sm-3 my-1 my-sm-0 btn btn-primary btn-180">Regresar</button>
                <button type="button" class="action submit mx-sm-3 my-1 my-sm-0 btn btn-secundary btn-180">Siguiente</button>
            </div>
        </div>
    </div>
</form>
