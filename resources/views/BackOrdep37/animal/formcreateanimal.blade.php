<form action="/Animal/agregar-animal" method="post" id="form_create_animal" class="form-app card border-0 shadow-none bg-transparent">
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
                <button type="submit" class="btn btn-secondary ms-4">Agregar</button>
            </div>
        </div>
    </div>
</form>


<script>
   document.addEventListener('DOMContentLoaded', function() {
    let selectTipo = document.getElementById('tipo_animal');

    function getSessionIdFromUrl() {
            const url = window.location.href;
            const parts = url.split('/');
            return parts[parts.length - 1]; // Asumiendo que el ID está al final de la URL
        }

      function loadData(){
        const sessionId = getSessionIdFromUrl();
        const urlTipo = `/Animal/tipos`;
        const urlSalud = `/Animal/salud`;
        const urlRebaño = `/Animal/rebano/${sessionId}`;
        const urlRaza = `/Animal/razas/${sessionId}`;

      let selectSalud = document.getElementById('estado_salud');
      let selectRebaño = document.getElementById('rebaño');
      let selectRaza = document.getElementById('raza');

      let placeholderOption = selectTipo.querySelector('option[hidden][value="tipo"]');
      let placeholderOptionSalud = selectSalud.querySelector('option[hidden][value="salud"]');
      let placeholderOptionRebaño = selectRebaño.querySelector('option[hidden][value="rebaño"]');
      let placeholderOptionRaza = selectRaza.querySelector('option[hidden][value="razas"]');

          fetch(urlTipo)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'OK') {

                        selectTipo.innerHTML = ''; // Limpiar el contenido anterior
                        selectTipo.appendChild(placeholderOption); // Volver a agregar el placeholder
                        data.data.forEach(tipo => {
                            const option = document.createElement('option');
                            option.value = tipo.tipo_animal_id;
                            option.textContent = tipo.tipo_animal_nombre;
                            selectTipo.appendChild(option);
                        });
                    }
                })
                .catch(error => console.error('Error:', error));
        
          fetch(urlSalud)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'OK') {

                        selectSalud.innerHTML = ''; // Limpiar el contenido anterior
                        selectSalud.appendChild(placeholderOptionSalud); // Volver a agregar el placeholder
                        data.data.forEach(salud => {
                            const option = document.createElement('option');
                            option.value = salud.estado_id;
                            option.textContent = salud.estado_nombre;
                            selectSalud.appendChild(option);
                        });
                    }
                })
                .catch(error => console.error('Error:', error));

          fetch(urlRebaño)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'OK') {

                        selectRebaño.innerHTML = ''; // Limpiar el contenido anterior
                        selectRebaño.appendChild(placeholderOptionRebaño); // Volver a agregar el placeholder
                        data.data.forEach(rebaño => {
                            const option = document.createElement('option');
                            option.value = rebaño.id_Rebano;
                            option.textContent = rebaño.Nombre;
                            selectRebaño.appendChild(option);
                        });
                    }
                })
                .catch(error => console.error('Error:', error));

        
          fetch(urlRaza)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'OK') {

                        selectRaza.innerHTML = ''; // Limpiar el contenido anterior
                        selectRaza.appendChild(placeholderOptionRaza); // Volver a agregar el placeholder
                        data.data.forEach(raza => {
                            const option = document.createElement('option');
                            option.value = raza.id_Composicion;
                            option.textContent = raza.Nombre;
                            selectRaza.appendChild(option);
                        });
                    }
                })
                .catch(error => console.error('Error:', error));
      }

      function loadEtapa(etapa_id){
        const urlEtapa = `/Animal/etapas/${etapa_id}`
        let selectEtapa = document.getElementById('etapa_animal');

        fetch(urlEtapa)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'OK') {

                        selectEtapa.innerHTML = ''; // Limpiar el contenido anterior
                       
                        data.data.forEach(etapa => {
                            const option = document.createElement('option');
                            option.value = etapa.etapa_id;
                            option.textContent = etapa.etapa_nombre;
                            selectEtapa.appendChild(option);
                        });
                    }
                })
                .catch(error => console.error('Error:', error));
      }

      // Agregar evento change al selectPadrote
     selectTipo.addEventListener('change', function() {
        const selectedTipoId = selectTipo.value;
        if (selectedTipoId) {
            loadEtapa(selectedTipoId);
        }
    });

      loadData();
   });
</script>

<script>
const form = document.getElementById('form_create_animal');

form.addEventListener('submit', (event) => { // Aquí se agregó la flecha
    event.preventDefault();

    const formData = new FormData(form);

    fetch(form.action, {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())  

    .then(data => {
        Swal.fire({
            title: '¡Éxito!',
            text: data.message,
            icon: 'success'
        });
    })
    .catch(error => {
        Swal.fire({
            title: 'Error',
            text: 'Ocurrió un error al crear el animal.',
            icon: 'error'
        });
    });
});
</script>

