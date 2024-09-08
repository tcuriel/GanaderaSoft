<form action="" method="post" id="form_modificar_animal" class="form-app card border-0 shadow-none bg-transparent">
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
                    id="nombre"
                    name="Nombre"
                    placeholder="Nombre"
                    data-numbers-only
                    data-pattern-input
                    data-pattern="^.{0,25}$">
                <span id="name-error" class="invalid-feedback font-weight-bold" role="alert"></span>
            </div>
            <div class="col-md-4 p-col-form">
              <label type="text"
                    for="codigo_animal"
                    class="form-label">Codigo Animal</label>
                
              <input type="text"
                      class="form-control"
                      id="codigo_animal"
                      name="codigo_animal"
                  > 
            
              </input>
            </div>
            <div class="col-md-4 p-col-form">
                <label type="text"
                    for="sex"
                    class="form-label"><span>(*)</span> Sexo</label>
                <select class="form-select w-100"
                    id="sex"
                    name="Sexo"
                    aria-label="select type sex"
                    required>
                    <option hidden value="" class="placeholder-style">Sexo</option>
                   
                    <option value="M">Macho</option>
                    <option value="H">Hembra</option>
                </select>
                <span id="sex-error" class="invalid-feedback font-weight-bold" role="alert"></span>
            </div>
            <div class="col-md-4 p-col-form">
                <label type="text"
                    for="age"
                    class="form-label"><span>(*)</span> Fecha de Nacimiento</label>
                    <i class="fa fa-info-circle fa-fw" aria-hidden="true" data-bs-placement="top" data-bs-toggle="popover" data-bs-content="No puede escoger una fecha posterior a la actual"></i>
                    <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento">
                  
            </div>

            <div class="col-md-4 p-col-form">
                <label type="text"
                    for="type"
                    class="form-label"><span>(*)</span> Tipo</label>
                <select class="form-select w-100"
                    id="tipo_animal"
                    name="tipo_animal"
                    aria-label="select type type"
                    required>
                    <option hidden value="tipo" class="placeholder-style">Tipo</option>
                   
                
                </select>
                <span id="type-error" class="invalid-feedback font-weight-bold" role="alert"></span>
            </div>
            <!-- La etapa vendra dada a partir del tipo escogido-->
            <div class="col-md-4 p-col-form">
                <label type="text"
                    for="stage"
                    class="form-label"><span>(*)</span> Etapa</label>
                <select class="form-select w-100"
                    id="etapa_animal"
                    name="etapa_animal"
                    aria-label="select stage stage"
                    required>
                    <option hidden value="" class="placeholder-style">Etapa</option>
                   
                </select>
                <span id="type-error" class="invalid-feedback font-weight-bold" role="alert"></span>
            </div>

            <div class="col-md-4 p-col-form">
                <label type="text"
                    for="state"
                    class="form-label"><span>(*)</span> Estado Salud</label>
                <select class="form-select w-100"
                    id="estado_salud"
                    name="estado_salud"
                    aria-label="select state type"
                    required>
                    <option hidden value="salud" class="placeholder-style"> Estado Salud</option>
                    <!--Estado salud -->
          
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
                    id="procedencia"
                    name="procedencia"
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
                    id="rebaño"
                    name="rebaño"
                    aria-label="select herd type"
                    required>
                    <option hidden value="rebaño" class="placeholder-style">Rebaño</option>
                   <!-- Rebaños -->
                </select>
                <span id="herd-error" class="invalid-feedback font-weight-bold" role="alert"></span>
            </div>

            <div class="col-md-4 p-col-form">
                <label type="text"
                    id="Razaletra"
                    class="form-label"><span>(*)</span>
                    Raza
                </label>
                <select class="form-select w-100"
                    id="raza"
                    name="raza"
                    aria-label="select herd type"
                    required>
                    <option hidden value="razas" class="placeholder-style">Raza</option>
                </select>
            </div>

        </div>
    </div>
    <div class="card-footer bg-transparent">
        <div class="row">
            <div class="col-md-5">
                <label class="form-label"><span class="text-danger">(*)</span>Estos Campos son Obligatorios</label>
            </div>
            <div class="col-md-7 d-flex flex-wrap justify-content-center justify-content-md-end">
                <a href="{{ url()->previous() }}" class="btn btn-primary-darck ms-2">Regresar</a>
                <button type="submit" class="btn btn-secondary ms-4">Modificar</button>
            </div>
        </div>
    </div>
</form>

<script>
     document.addEventListener('DOMContentLoaded', function() {
    const urlTipo = `/Animal/tipos`;
    const urlSalud = `/Animal/salud`;

    function getSessionIdFromUrl() {
        const url = window.location.href;
        const parts = url.split('/');
        return parts[parts.length - 1]; // Asumiendo que el ID está al final de la URL
    }
    const animalID = getSessionIdFromUrl();

    fetch(`/Animal/detalle/${animalID}`)
        .then(response => response.json())
        .then(data => {
            console.log(data); // Verificar la estructura de los datos
            if (data.status === 'OK') {
                const animal = data.data[0];
                document.getElementById('nombre').value = animal.animal_nombre || '';
                document.getElementById('codigo_animal').value = animal.codigo_animal || '';
                document.getElementById('sex').value = animal.Sexo || '';
                document.getElementById('fecha_nacimiento').value = animal.fecha_nacimiento || '';
                document.getElementById('tipo_animal').value = animal.tipo_animal || '';
                document.getElementById('procedencia').value = animal.Procedencia || '';

                // Agregar opciones al select de raza y establecer el valor
                const razaSelect = document.getElementById('raza');
                const razaOption = document.createElement('option');
                razaOption.value = animal.Nombre;
                razaOption.text = animal.Nombre;
                razaOption.selected = true;
                razaSelect.appendChild(razaOption);

                // Agregar opciones al select de etapa y establecer el valor
                const etapaSelect = document.getElementById('etapa_animal');
                const etapaOption = document.createElement('option');
                etapaOption.value = animal.etapa_nombre;
                etapaOption.text = animal.etapa_nombre;
                etapaOption.selected = true;
                etapaSelect.appendChild(etapaOption);

                // Agregar opciones al select de tipo de animal y establecer el valor
                const tipoSelect = document.getElementById('tipo_animal');
                const tipoOption = document.createElement('option');
                tipoOption.value = animal.tipo_animal_nombre;
                tipoOption.text = animal.tipo_animal_nombre;
                tipoOption.selected = true;
                tipoSelect.appendChild(tipoOption);

                // Agregar opciones al select de rebaño y establecer el valor
                const rebanoSelect = document.getElementById('rebaño');
                const rebanoOption = document.createElement('option');
                rebanoOption.value = animal.rebano;
                rebanoOption.text = animal.rebano;
                rebanoOption.selected = true;
                rebanoSelect.appendChild(rebanoOption);

                // Fetch para obtener los datos de salud
                fetch(urlSalud)
                    .then(response => {
                        console.log(response); // Verificar la respuesta del servidor
                        return response.json();
                    })
                    .then(saludData => {
                        console.log(saludData); // Verificar la estructura de los datos de salud
                        const saludSelect = document.getElementById('estado_salud');
                        saludData.forEach(salud => {
                            const option = document.createElement('option');
                            option.value = salud.estado_id;
                            option.textContent = salud.estado_nombre;
                            if (salud.estado_nombre === animal.estado_nombre) {
                                option.selected = true;
                            }
                            saludSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error al obtener los datos de salud:', error));
            } else {
                console.error('Error:', data.message);
            }
        })
        .catch(error => {
            console.error('Error al obtener los datos del animal:', error);
        });
});

</script>
