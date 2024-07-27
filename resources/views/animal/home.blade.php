<div class="row">
    <div class="col-12">
        <a href="{{ route('home') }}" class="gren-text-color font-weight-bold float-right my-3 d-block"> Listado de fincas</a>
    </div>
    <div class="col-12">
        <div class="row g-3">
            <div class="col-12 col-md-6">
                <div class="row g-3 align-items-center">
                    <form action="" class="form-app">
                        @csrf
                        <div class="form-group row">
                            <label for="selectView" class="col-sm-3 col-form-label gren-text-color title-selector-views">¿Qué deseas ver?</label>
                            <div class="col-sm-auto">
                                <select class="form-select"
                                    id="selectView"
                                    name="selectView"
                                    aria-label="select type Exploitation"
                                    onchange="selectorView(this.value)"
                                    required>
                                        <option value="animal" selected>Animal</option>
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 col-md-6">
            @if($selectView == "animal")
            <div class="row g-3">
                <div class="col-12">
                    <a href="{{url('/finca/animal/agregar/'.$data[0]->id_Finca)}}" id="addRebano" class="btn btn-primary btn-primary-darck float-right">Agregar Animal <i class="fas fa-fw fa-plus"></i> </a>
                </div>
                <div class="col-12">
                    @if(!empty($listRebano))
                    <a href="{{url('/finca/rebano/'.$data[0]->id_Finca.'/up/'.$listRebano[0]->id_Rebano)}}" id="addRebanoLot" class="btn btn-primary btn-primary-darck float-right">Subir Animales <i class="fas fa-fw fa-plus"></i> </a>
                    @endif
                </div>
            </div>
            @endif
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="row g-3 align-items-center">
            <form action="" id="rebanoSelect" class="form-app">
                @csrf
                <div class="form-group row">
                    <label for="herd" class="col-sm-3 col-form-label gren-text-color title-selector-views">Selecciona un Rebaño</label>
                    <div class="col-sm-auto">
                        <select class="form-select"
                            id="herd"
                            name="herd"
                            aria-label="select type Herd"
                            required>
                                @foreach ($listRebano as $clave => $valor)
                                    @if ($loop->first)
                                        <option value="{{$valor->id_Rebano}}" selected>{{$valor->Nombre}}</option>
                                    @else
                                        <option value="{{$valor->id_Rebano}}">{{$valor->Nombre}}</option>
                                    @endif
                                @endforeach
                        </select>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div id="contenedor-blade" class="col-12">

        @if($selectView == "animal")
            @include('animal.homeanimal')
        @endif

    </div>
</div>
@section('js-content-home')
        <script>
            function selectorView(view) {
                const section = "{{$section}}";
                const id_finca = "{{$data[0]->id_Finca}}"
                const URL = "/dashboard/" + section + "/" + view + "/" + id_finca;
                window.location.href =URL;
            }
            window.dataFinca = '{!! json_encode($data) !!}';
            window.dataRebano = '{!! json_encode($listRebano) !!}';
        </script>
    @if($selectView == "animal")
        <script>
            window.list_animal = "{{config('app.action-get-urls.list_animal')}}";
        </script>
        @vite(['resources/js/animal/homeanimal.js'])
    @endif
@stop
