<div class="row">
    <div class="col-12 col-md-4 col-lg-3">
        <form action="" class="form-app">
            <div class="form-group-flex">
                <select class="form-select w-100"
                    id="selectInventario"
                    name="selectInventario"
                    aria-label="select type"
                    required>
                    @foreach ($inventarioRequests as $clave => $valor)
                    <option value="{{$clave}}">{{$valor}}</option>
                    @endforeach
                </select>
                <div class="input-group">
                    <input type="search"
                        class="form-control bg-white"
                        id="searchFarm"
                        name="searchFarm"
                        placeholder="DD/MM/YYYY"
                        aria-describedby="button-addon2">
                    <button class="tg-input"
                        type="button"
                        id="-button"><i class="fas fa-fw fa-search"></i>
                    </button>
                </div>
            </div>
        </form>
        
    </div>
    <div class="col-12 col-md-8 col-lg-9">

    </div>
    <div class="col-12 col-md-4 col-lg-3 list-group-ulcontainer">
        
        <ul id="list-invetario" class="list-group list-group-flush">
            <!--li-- class="list-group-item">
                <div class="row continer-item-list inventario-item active">
                    <div class="col-12 iconinventariofarm text-left">
                        <h4 class="mb-1">ID: 001</h4>
                        <p>Fecha: 14/01/2024</p>
                    </div>
                </div>
            </!--li-->
        </ul>

    </div>
    <div class="col-12 col-md-8 col-lg-9">

        <div class="row">
            <div id="inventory-content" class="col-12">

                <!--div-- id="inventory-details" class="card">
                    <div class="card-header">
                        <h4 class="text-center">Detalle del Inventario (<span>001</span>)</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush list-group-inventario">
                            <li class="list-group-item d-flex flex-row justify-content-between"><span>ID</span><span>001</span></li>
                            <li class="list-group-item d-flex flex-row justify-content-between"><span>Numero de Personal</span><span>24</span></li>
                            <li class="list-group-item d-flex flex-row justify-content-between"><span>Fecha del Inventario</span><span>14/01/2024</span></li>
                        </ul>
                    </div>
                </!--div-->

            </div>
        </div>


    </div>
</div>
