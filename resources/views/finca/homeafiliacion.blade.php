<div class="row">
    <div class="col-12 col-md-8 col-lg-9">

    </div>
    <div class="col-12 col-md-4 col-lg-3">

        <form action="" class="form-app">
            <div class="form-group-flex">
                <select class="form-select w-100"
                    id="selectStatus"
                    name="selectStatus"
                    aria-label="select type"
                    required>
                    @foreach ($statusFarms as $statusFarm)
                    <option value="{{$statusFarm}}">{{$statusFarm}}</option>
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
            <div class="w-100 mt-3">
                <select class="form-select w-100"
                    id="selectSolicitud"
                    name="selectSolicitud"
                    aria-label="select type"
                    required>
                    @foreach ($personalRequests as $clave => $valor)
                    <option value="{{$clave}}">{{$valor}}</option>
                    @endforeach
                </select>

            </div>
        </form>
        
    </div>
    <div class="col-12 col-md-8 col-lg-9">
        ESTADISTICAS AFILIACION
    </div>
    <div class="col-12 col-md-4 col-lg-3 list-group-ulcontainer afiliacion-list">
        
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <div class="row continer-item-list text-center">
                    <div class="col-6 idafiliacionfarm">
                        <p class="mb-0">Manuel Vargas</p>
                        <p class="mb-1">ID 4368265</p>
                    </div>
                    <div class="col-6 iconafiliacionfarm text-center">
                        <p class="mb-0">Transcriptor</p>
                        <p class="mb-1">Veterinario</p>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="row continer-item-list text-center">
                    <div class="col-6 idafiliacionfarm">
                        <p class="mb-0">Manuel Vargas</p>
                        <p class="mb-1">ID 4368265</p>
                    </div>
                    <div class="col-6 iconafiliacionfarm text-center">
                        <p class="mb-0">Transcriptor</p>
                        <p class="mb-1">Veterinario</p>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="row continer-item-list text-center">
                    <div class="col-6 idafiliacionfarm">
                        <p class="mb-0">Manuel Vargas</p>
                        <p class="mb-1">ID 4368265</p>
                    </div>
                    <div class="col-6 iconafiliacionfarm text-center">
                        <p class="mb-0">Transcriptor</p>
                        <p class="mb-1">Veterinario</p>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="row continer-item-list text-center">
                    <div class="col-6 idafiliacionfarm">
                        <p class="mb-0">Manuel Vargas</p>
                        <p class="mb-1">ID 4368265</p>
                    </div>
                    <div class="col-6 iconafiliacionfarm text-center">
                        <p class="mb-0">Transcriptor</p>
                        <p class="mb-1">Veterinario</p>
                    </div>
                </div>
            </li>
            <li class="list-group-item">
                <div class="row continer-item-list text-center">
                    <div class="col-6 idafiliacionfarm">
                        <p class="mb-0">Manuel Vargas</p>
                        <p class="mb-1">ID 4368265</p>
                    </div>
                    <div class="col-6 iconafiliacionfarm text-center">
                        <p class="mb-0">Transcriptor</p>
                        <p class="mb-1">Veterinario</p>
                    </div>
                </div>
            </li>
        </ul>

    </div>
</div>
