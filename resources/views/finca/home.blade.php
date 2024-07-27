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
                                    @foreach ($selectorViews as $clave => $valor)
                                        @if($clave != $selectView)
                                            <option value="{{$clave}}">{{$valor}}</option>
                                        @else
                                            <option value="{{$clave}}" selected>{{$valor}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-12 col-md-6">
            @if($selectView == "rebano")
                <a href="{{url('dashboard/finca/rebano/agregar/'.$data->id_Finca)}}" id="addRebano" class="btn btn-primary btn-primary-darck float-right">Agregar Rebaño <i class="fas fa-fw fa-plus"></i> </a>
            @elseif($selectView == 'personal')
                <a href="{{url('dashboard/finca/personal/agregar/'.$data->id_Finca)}}" id="addPersonal" class="btn btn-primary btn-primary-darck float-right">Agregar Personal <i class="fas fa-fw fa-plus"></i> </a>
            @elseif($selectView == 'afiliacion')
                <a href="{{url('dashboard/finca/afiliacion/'.$data->id_Finca)}}" id="addAfiliacion" class="btn btn-primary btn-primary-darck float-right">Añadir Afiliacion <i class="fas fa-fw fa-plus"></i> </a>
            @elseif($selectView == 'inventario')
                <a href="{{url('dashboard/finca/inventario/agregar/'.$data->id_Finca)}}" id="addInventario" class="btn btn-primary btn-primary-darck float-right">Añadir Inventario <i class="fas fa-fw fa-plus"></i> </a>
            @elseif($selectView == 'finca')
                <!--a href="{{url('dashboard/finca/rebano/'.$data->id_Finca)}}" id="fincaUp" class="btn btn-primary btn-primary-darck float-right"> </!--a-->
                <div class="btn-toolbar justify-content-end" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group mr-2" role="group">
                        <button type="button" id="fincaSave" class="btn btn-primary float-right"><i class="fa fa-file"></i> Archivar</button>
                    </div>
                    <div class="btn-group mr-2" role="group">
                        <button type="button" id="fincaDelete" class="btn btn-danger float-right"><i class="fa fa-minus"></i> Eliminar</button>
                    </div>
                </div>
            @endif
            </div>
        </div>
    </div>
    <div id="contenedor-blade" class="col-12">

        @if($selectView == "rebano")
            @include('finca.homerebano', ['statusRebanoFarms' => config('app.filter-renano')])
        @elseif($selectView == 'personal')
            @include('finca.homepersonal', ['statusPersonalFarms' => config('app.filter-personal')])
        @elseif($selectView == 'afiliacion')
            @include('finca.homeafiliacion')
        @elseif($selectView == 'inventario')
            @include('finca.homeinventario')
        @elseif($selectView == 'finca')
            @include('finca.homefinca')
        @endif

    </div>
</div>
@section('js-content-home')
        <script>
            function selectorView(view) {
                const section = "{{$section}}";
                console.log("{{$data[0]->id_Finca}}");
                const id_finca = "{{$data[0]->id_Finca}}";
                const URL = "/dashboard/" + section + "/" + view + "/" + id_finca;
                window.location.href =URL;
            }
            window.dataFinca = '{!! json_encode($data) !!}';
        </script>
    @if($selectView == "rebano")
        <script>
            window.list_rebano = "{{config('app.action-get-urls.list_rebano')}}";
            window.get_rebano = "{{config('app.action-get-urls.get_rebano')}}";
        </script>
        @vite(['resources/js/finca/homefincarebano.js'])
    @elseif($selectView == 'personal')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            window.list_personal = "{{config('app.action-get-urls.list_personal')}}";
            window.get_personal = "{{config('app.action-get-urls.get_personal')}}";
        </script>
        @vite(['resources/js/finca/homefincapersonal.js'])
    @elseif($selectView == 'afiliacion')
    <script>console.log("HOLA afiliacion");</script>
    @elseif($selectView == 'inventario')
        <script>
            window.list_inventario = "{{config('app.action-get-urls.list_inventario')}}";
            window.get_inventario = "{{config('app.action-get-urls.get_inventario')}}";
            window.inventario_selector = "{{implode(',', array_keys(config('app.inventario-selector')))}}";
        </script>
        @vite(['resources/js/finca/homefincainventario.js'])
    @elseif($selectView == 'finca')
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
        <script>
            window.actionGet = "{{config('app.action-get-urls.find_farmFUllData')}}";
        </script>
        @vite(['resources/js/finca/homefincamifinca.js'])
    @endif
@stop
