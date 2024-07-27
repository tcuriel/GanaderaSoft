<form action="{{config('app.action-post-urls.update_farm')}}"  method="post" id="form_update_farm" class="form-dashboard card border-0 shadow-none bg-transparent">
    @csrf
    <div class="card-body pr-xl-5 stepfarm">
        <div class="row">
            <div class="col-md-6 p-col-form">
                <div class="form-container-inputs">
                    <label type="text"
                        for="name"
                        class="form-label"><span>(*)</span> Nombre de la finca</label>
                    <i class="fa fa-info-circle fa-fw" aria-hidden="true" data-bs-placement="top" data-bs-toggle="popover" data-bs-content="Debe poseer 25 caracteres como máximo"></i>
                    <input type="text"
                        class="form-control"
                        id="name"
                        name="name"
                        placeholder="Nombre"
                        data-numbers-only
                        data-pattern="^.{0,25}$"
                        required>
                    <span id="name-error" class="invalid-feedback font-weight-bold" role="alert"></span>
                </div>
            </div>
            <div class="col-md-6 p-col-form">
                <div class="form-container-inputs">
                    <label type="text"
                        for="exploitation"
                        class="form-label"><span>(*)</span> Explotación</label>
                    <select class="form-select w-100"
                        id="exploitation"
                        name="exploitation"
                        aria-label="select type Exploitation"
                        required>
                        <option hidden value="" class="placeholder-style">Explotación</option>
                        @foreach ($exploitations as $exploitation)
                        <option value="{{$exploitation}}">{{$exploitation}}</option>
                        @endforeach
                    </select>
                    <span id="exploitation-error" class="invalid-feedback font-weight-bold" role="alert"></span>
                </div>
            </div>
            <div class="col-md-6 p-col-form">
                <div class="form-container-inputs">
                    <label type="text"
                        for="iron"
                        class="form-label">Identificador (Opcional)</label>
                    <i class="fa fa-info-circle fa-fw" aria-hidden="true" data-bs-placement="top" data-bs-toggle="popover" data-bs-content="Debe poseer 10 caracteres"></i>
                    <input type="text"
                        class="form-control"
                        id="idiron"
                        name="idiron"
                        placeholder="Identificador">
                    <span id="idiron-error" class="invalid-feedback font-weight-bold" role="alert"></span>
                </div>
            </div>
            <div class="col-md-6 p-col-form">
                <div class="form-container-inputs">
                    <label type="text"
                        for="irrigation-method"
                        class="form-label">Método de Riego (Opcional)</label>
                    <select class="form-select w-100"
                        id="irrigation-method"
                        name="irrigation-method"
                        aria-label="select type Irrigation">
                        <option hidden value="" class="placeholder-style">Método de Riego</option>
                        @foreach ($methods as $method)
                        <option value="{{$method}}">{{$method}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6 p-col-form">
                <div class="form-container-inputs">
                    <label type="text"
                        for="annual-temperature"
                        class="form-label">Temperatura Anual (Opcional)</label>
                    <div class="input-group">
                        <input type="text"
                            class="form-control"
                            id="annual-temperature"
                            name="annual-temperature"
                            placeholder="Temperatura Anual"
                            data-numbers-only
                            data-pattern="^\d{1,2}?(\.\d{0,1})?$"><!---numeros-->
                        <span class="tg-input">C°</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 p-col-form">
                <div class="form-container-inputs">
                    <label type="text"
                        for="soil-ph"
                        class="form-label">PH del Suelo (Opcional)</label>
                    <select class="form-select w-100"
                        id="soil-ph"
                        name="soil-ph"
                        aria-label="select type Exploitation">
                        <option hidden value="" class="placeholder-style">PH del Suelo</option>
                        @foreach ($phs as $ph)
                        <option value="{{$ph}}">{{$ph}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6 p-col-form">
                <div class="form-container-inputs">
                    <label type="text"
                        for="vailable-flow"
                        class="form-label">Caudal Disponible (Opcional)</label>
                    <div class="input-group">
                        <input type="text"
                            class="form-control"
                        id="vailable-flow"
                        name="vailable-flow"
                        placeholder="Caudal Disponible"
                            data-numbers-only
                            data-pattern="^\d{1,10}?(\.\d{0,2})?$"><!---numeros-->
                        <span class="tg-input">QD</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 p-col-form">
                <div class="form-container-inputs">
                    <label type="text"
                        for="hierroInput"
                        class="form-label">Relieve (Opcional)</label>
                    <select class="form-select w-100"
                        id="relief"
                        name="relief"
                        aria-label="select type Relieve">
                        <option hidden value="" class="placeholder-style">Relieve</option>
                        @foreach ($reliefes as $relief)
                        <option value="{{$relief}}">{{$relief}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body pr-xl-5 stepfarm" style="display: none">
        <div class="row">
            <div class="col-md-6 p-col-form">
                <div class="form-container-inputs">
                    <label type="text"
                        for="precipitation"
                        class="form-label">Precipitación (Opcional)</label>
                    <div class="input-group">
                        <input type="text"
                            class="form-control"
                            id="precipitation"
                            name="precipitation"
                            placeholder="Precipitación"
                            data-numbers-only
                            data-pattern="^\d{1,10}?(\.\d{0,2})?$"><!---numeros-->
                        <span class="tg-input">mm</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 p-col-form">
                <div class="form-container-inputs">
                    <label type="text"
                        for="soil-texture"
                        class="form-label">Textura del Suelo (Opcional)</label>
                    <select class="form-select w-100"
                        id="soil-texture"
                        name="soil-texture"
                        aria-label="select type Textura del Suelo">
                        <option hidden value="" class="placeholder-style">Textura del Suelo</option>
                        @foreach ($textures as $texture)
                        <option value="{{$texture}}">{{$texture}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6 p-col-form">
                <div class="form-container-inputs">
                    <label type="text"
                        for="maximum-temperature"
                        class="form-label">Temperatura Máxima (Opcional)</label>
                    <div class="input-group">
                        <input type="text"
                            class="form-control"
                            id="maximum-temperature"
                            name="maximum-temperature"
                            placeholder="Temperatura Máxima"
                            data-numbers-only
                            data-pattern="^\d{1,2}?(\.\d{0,1})?$"><!---numeros-->
                        <span class="tg-input">C°</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 p-col-form">
                <div class="form-container-inputs">
                    <label type="text"
                        for="wind-speed"
                        class="form-label">Velocidad del Viento (Opcional)</label>
                    <div class="input-group">
                        <input type="text"
                            class="form-control"
                            id="wind-speed"
                            name="wind-speed"
                            placeholder="Velocidad del Viento"
                            data-numbers-only
                            data-pattern="^\d{1,10}?(\.\d{0,2})?$"><!---numeros-->
                        <span class="tg-input">Km/H</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 p-col-form">
                <div class="form-container-inputs">
                    <label type="text"
                        for="minimum-temperature"
                        class="form-label">Temperatura Mínima (Opcional)</label>
                    <div class="input-group">
                        <input type="text"
                            class="form-control"
                            id="minimum-temperature"
                            name="minimum-temperature"
                            placeholder="Temperatura Mínima"
                            data-numbers-only
                            data-pattern="^\d{1,2}?(\.\d{0,1})?$"><!---numeros-->
                        <span class="tg-input">C°</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 p-col-form">
                <div class="form-container-inputs">
                    <label type="text"
                        for="surface"
                        class="form-label">Superficie (Opcional)</label>
                    <div class="input-group">
                        <input type="text"
                            class="form-control"
                            id="surface"
                            name="surface"
                            placeholder="Superficie"
                            data-numbers-only
                            data-pattern="^\d{1,10}?(\.\d{0,2})?$"><!---numeros-->
                        <span class="tg-input">km²</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 p-col-form">
                <div class="form-container-inputs">
                    <label type="text"
                        for="radiation"
                        class="form-label">Radiación (Opcional)</label>
                    <div class="input-group">
                        <input type="text"
                            class="form-control"
                            id="radiation"
                            name="radiation"
                            placeholder="Radiacion"
                            data-numbers-only
                            data-pattern="^\d{1,10}?(\.\d{0,2})?$"><!---numeros-->
                        <span class="tg-input">Kw/H</span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 p-col-form">
                <div class="form-container-inputs">
                    <label type="text"
                        for="water-fontain"
                        class="form-label">Fuente de Agua (Opcional)</label>
                    <select class="form-select w-100"
                        id="water-fontain"
                        name="water-fontain"
                        aria-label="select type Fuente de Agua">
                        <option hidden value="" class="placeholder-style">Fuente de Agua</option>
                        @foreach ($fontaines as $fontain)
                        <option value="{{$fontain}}">{{$fontain}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer bg-transparent">
        <div class="row">
            <div class="col-md-5">
                <label class="form-label"><span class="text-danger">(*)</span>Estos Campos son Obligatorios</label>
            </div>
            <div class="col-md-7 d-flex flex-wrap justify-content-center justify-content-md-end">
                <button type="button" class="action backfarm mx-sm-3 my-1 my-sm-0 btn btn-primary btn-180 backtoback" style="display: none">Regresar</button>
                <button type="button" class="action nextfarm mx-sm-3 my-1 my-sm-0 btn btn-secundary btn-180">Siguiente</button>
                <button type="button" id="submitfarm" class="action submitfarm mx-sm-3 my-1 my-sm-0 btn btn-secundary btn-180" style="display: none">Actualiz ar Datos <i class="fa fa-arrow-up"></i></button>
            </div>
        </div>
    </div>
</form>
