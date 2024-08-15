
<div class="container">
  <h2>Agregar datos del servicio</h2>
  <form class="row g-3" method="POST" action="{{ url('/Reproduccion/registrar-servicio') }}">
    @csrf
    <input type="hidden" id="id_Animal" name="servicio_id_Animal">

    <div>
      <div class="row">
        <h3>Informacion del servicio</h3>
        <div class="col-3">
          <label for="fechaServicio" class="form-label">Fecha del servicio</label>
          <input type="date" class="form-control" id="fechaServicio" name="servicio_fecha">
        </div>

        <div class="col-3">
          <label for="tipoServicio" class="form-label">Tipo del servicio</label>
          <select class="form-select" aria-label="Default select example" name="servicio_tipo">
            <option value="natural" selected>Natural</option>
            <option value="artificial">Artificial</option>
          </select>
        </div>

        <div class="col-4">
          <label for="descripcionServicio" class="form-label">Descripcion del servicio</label>
          <textarea class="form-control" id="descripcionServicio" name="servicio_observacion" rows="3"></textarea>
        </div>
      </div>
    </div>

    <div>
      <h3>Datos del padrote y su semen (Opcional)</h3>
      <div class="col-3">
        <label for="padrote" class="form-label">Padrote</label>
        <select class="form-select" aria-label="Default select example" id="selectPadrote" name="padrote">
          <!-- Opciones cargadas dinámicamente -->
        </select>
      </div>

      <div class="col-3">
        <label for="semen" class="form-label">ID del semen del padrote a usar</label>
        <select class="form-select" aria-label="Default select example" id="selectSemen" name="servicio_semen_id">
          <option selected>Selecciona un semen</option>
          <!-- Opciones cargadas dinámicamente -->
        </select>
      </div>
    </div>

    <div>
      <h3>Datos del celo del animal</h3>
      <div class="col-3">
        <label for="celo" class="form-label">Celo asociado</label>
        <select class="form-select" aria-label="Default select example" id="selectCelo" name="servicio_celo_id">
          <!-- Opciones cargadas dinámicamente -->
        </select>
      </div>
    </div>

    <div class="row">
      <div class="col text-end">
        <div class="d-flex justify-content-end">
          <a href="" class="btn btn-primary-darck ms-2">Regresar</a>
          <button type="submit" class="btn btn-secondary ms-4">Guardar</button>
        </div>
      </div>
    </div>
  </form>
</div>



<script>
   document.addEventListener('DOMContentLoaded', function() {
    let idAnimalInput = document.getElementById('id_Animal');
       // Función para obtener el ID de la URL
       function getSessionIdFromUrl() {
            const url = window.location.href;
            const parts = url.split('/');
            return parts[parts.length - 1]; // Asumiendo que el ID está al final de la URL
        }

        const sessionId = getSessionIdFromUrl();

        if(sessionId){
          idAnimalInput.value = sessionId;
        }
 
        function loadData(){
          const urlcelo = `/Reproduccion/registros-celo/${sessionId}`;
          const urlPadrote = `/Reproduccion/registros-padrote/${sessionId}`;

          let selectCelo = document.getElementById('selectCelo');
          let selectPadrote = document.getElementById('selectPadrote');
          let selectSemen = document.getElementById('selectSemen');

          fetch(urlcelo)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'OK') {

                        selectCelo.innerHTML = ''; // Limpiar el contenido anterior
                        data.data.forEach(celo => {
                            const option = document.createElement('option');
                            option.value = celo.celo_id;
                            option.textContent = celo.celo_fecha;
                            selectCelo.appendChild(option);
                        });
                    }
                })
                .catch(error => console.error('Error:', error));

              fetch(urlPadrote)
                .then(response => response.json())
                .then(data => {
                    if(data.status === 'OK'){
                        selectPadrote.innerHTML = '';
                        data.data.forEach(padrote => {
                          const option = document.createElement('option');
                          option.value = padrote.id_Toro;
                          option.textContent = padrote.nombre;
                          selectPadrote.appendChild(option);
                        });
                    }
                })
                .catch(error => console.error('Error:', error));
        }

         // Función para cargar el semen basado en el padrote seleccionado
    function loadSemen(padroteId) {
        const urlSemen = `/Reproduccion/registros-semen/${padroteId}`;

        fetch(urlSemen)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'OK') {
                    selectSemen.innerHTML = '<option selected>Selecciona un semen</option>';
                    data.data.forEach(semen => {
                        const option = document.createElement('option');
                        option.value = semen.semen_id;
                        option.textContent = semen.semen_fecha;
                        selectSemen.appendChild(option);
                    });
                }
            })
            .catch(error => console.error('Error:', error));
    }

     // Agregar evento change al selectPadrote
     selectPadrote.addEventListener('change', function() {
        const selectedPadroteId = selectPadrote.value;
        if (selectedPadroteId) {
            loadSemen(selectedPadroteId);
        }
    });

        loadData();
   });
</script>