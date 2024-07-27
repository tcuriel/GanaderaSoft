<form class="form-app my-2 bg-grey" id="welcomefarms" action="{{config('app.action-get-urls.find_farm')}}" method="get">
    {{ csrf_field() }}
    <!-- Auth::user() -->
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 order-lg-1 order-md-2 order-2 pb-3">
                <div class="input-group">
                    <input type="search"
                        class="form-control bg-white"
                        id="searchFarm"
                        name="searchFarm"
                        placeholder="Nombre"
                        aria-describedby="button-addon2">
                    <button class="tg-input"
                        type="button"
                        id="-button"><i class="fas fa-fw fa-search"></i></button>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 order-lg-2 order-md-1 order-1 pb-3"> <!-- "{{ route('createmyfarmI') }}" {{ route('users.option.list', ['opcion' => 'mixto', 'archivado' => 0]) }}-->
                <a href="{{ route('createmyfarmI') }}" type="button" id="createfarm" name="createfarm" class="btn btn-secundary btn-secundary-darck"><i class="fas fa-fw fa-plus"></i> Crear Finca</a>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6 col-md-12 order-lg-3 order-md-4 order-4">

                <div class="row g-3 align-items-center">
                    <div class="col-auto">
                        <h2 for="selectStatusFarm" class="primary-text-color">Mis Fincas</h2>
                    </div>
                    <div class="col">
                        <select class="form-select w-100"
                            id="selectStatusFarm"
                            name="selectStatusFarm"
                            aria-label="select type Exploitation"
                            required>
                            @foreach ($statusFarms as $statusFarm)
                            <option value="{{$statusFarm}}">{{$statusFarm}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row g-3 align-items-center py-3">
                    <div class="col-12 list-group list-farm">
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($farms as $farm)
                            @php
                                $i++;
                            @endphp
                            <button type="button" class="list-farms list-group-item list-group-item-action {{ $i === 1 ? 'active' : '' }}" aria-current="true" data-farmid="{{ $farm->id_Finca }}">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-1">{{ $farm->Nombre }}</h5>
                                </div>
                                <img src="https://ui-avatars.com/api/?name={{$farm->Nombre}}" class="rounded-circle float-end" alt="">
                            </button>
                        @endforeach
                    </div>
                </div>

            </div>
            <div class="col-lg-6 col-md-12 order-lg-4 order-md-3 order-3 primary-color-bg b-lefttop-4">
                <div class="d-flex flex-column justify-content-center h-100 py-3">
                    <h2 class="pt-3 pb-3 text-center" id="farmName"><i class="ico ico_farm mr-1"></i> {{ $farms[0]->Nombre }} </h2>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item" id="farmId"><i class="ico ico_idfarm"></i>ID: {{ $farms[0]->id_Finca }}</li>
                        <li class="list-group-item"><i class="ico ico_herd"></i> de Rebaños: 0</li>
                        <li class="list-group-item"><i class="ico ico_animal"></i> de Animales: 0</li>
                        <li class="list-group-item"><i class="ico ico_cowlboy"></i> de Transcriptores: 0</li>
                    </ul>
                    <a href="dashboard/finca/rebano/{{ $farms[0]->id_Finca }}" id="viewfarm" name="viewfarm" class="btn btn-primary btn-primary-darck mt-3">Ver Mi Finca</a>
                </div>
            </div>
        </div>

    </div>
</form>
