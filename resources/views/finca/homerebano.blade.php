<div class="row">
    <div class="col-12 col-md-8 col-lg-9">

    </div>
    <div class="col-12 col-md-4 col-lg-3">

        <form action="" class="form-app">
            <div class="form-group-flex">
                
                <div style="border: 1px solid black;border-radius: 10px;width: 100px;margin-right: 2px">
                <select class="form-select w-100"
                    id="selectStatusRebanoFarm"
                    name="selectStatusRebanoFarm"
                    aria-label="select type"
                    required>
                    @foreach ($statusRebanoFarms as $statusRebanoFarm)
                    <option value="{{$statusRebanoFarm}}">{{$statusRebanoFarm}}</option>
                    @endforeach
                </select>
                </div>
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
    <div class="col-12 col-md-8 col-lg-9 container-dashboard-farm">
        <div id="rebanoStatistics">
            <header class="learning-ui">
                <h1 class="text-primary">ESTADISTICAS REBAÑOS</h1>
                <p></p>
            </header>
            <section class="charts">
                <div id="totals"></div>
                <div id="by-school"></div>
            </section>
        </div>
        <div id="rebanoContenForm" style="display:none;">
            <form action="{{config('app.action-post-urls.rebano_farm').Auth::user()->id}}" id="form_rebano_farm" class="form-dashboard card border-0 shadow-none bg-transparent">
                @csrf
                <div class="card-body pr-xl-5">
                    <div class="row">
                        <div class="col-12">
                            <h2 id="tName" class="title-blue text-bold"> </h2>
                        </div>
                        <div class="col-md-6 p-col-form">

                            <div class="form-container-inputs">
                                <label type="text"
                                    for="name"
                                    class="form-label">Nombre</label>
                                <input type="text"
                                    class="form-control"
                                    id="name"
                                    name="name"
                                    placeholder="Nombre Rebaño">
                                <span id="name-error" class="invalid-feedback font-weight-bold" role="alert"></span>
                            </div>
                        </div>

                    </div>
                    <!--div class="row">
                        <div class="col-12">
                            <h2>Animales</h2>
                        </div>
                        <div class="col-md-6 p-col-form">
                            <div class="form-container-inputs">
                                <label type="text"
                                    for="name"
                                    class="form-label">Campo Animales</label>
                                <input type="text"
                                    class="form-control"
                                    id="field5"
                                    name="field5"
                                    placeholder="field5">
                                <span id="field5-error" class="invalid-feedback font-weight-bold" role="alert"></span>
                            </div>
                        </div><div class="col"></div>
                    </!--div-->
                </div>
                <div class="card-footer bg-transparent">
                    <div class="row justify-content-between">
                        <div class="col-md-auto">
                            <!--label class="form-label"><span class="text-danger">(*)</span>Estos Campos son Obligatorios</!--label-->
                        </div>
                        <div class="col-md-auto d-flex flex-wrap justify-content-end">
                            <button type="button" class="mx-1 my-1 my-sm-0 btn btn-secundary" disabled>Archivar<br>Rebaño</button>
                            <button type="button" class="mx-1 my-1 my-sm-0 btn" disabled>Mover<br>Rebaño</button>
                            <button type="button" class="mx-1 my-1 my-sm-0 btn btn-primary-darck" disabled>Modificar<br>Rebaño</button>
                            <button type="button" class="mx-1 my-1 my-sm-0 btn btn-danger" disabled>Eliminar<br>Rebaño</button>
                        </div>
                    </div>
                </div>
            </form>

        </div>

    </div>
    
    <div class="col-12 col-md-4 col-lg-3 list-group-ulcontainer">
    <div class="card">    
        <ul id="listRebano" class="list-group list-group-flush">

        </ul>

    </div>
    </div>
</div>

