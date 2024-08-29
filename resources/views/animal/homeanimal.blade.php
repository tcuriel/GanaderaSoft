<div id="listAnimal">
    <!--div-- class="row g-3 continer-item-list">
        <div class="col-7 mt-0 iconanimalcow">
            <h4 class="mb-1">Animal</h4>
            <p class="mb-1"></p>
        </div>
        <div class="col-5 mt-0 align-content-around text-right">
            <button type="button" id="listItem1" class="btn btn-secundary btn-secundary-darck">Ver Animal</button>
        </div>
    </!--div-->
    <div class="row g-3">
        <div class="col">
            <table id="animalTable" class="display">
                <thead id="tableHead">
                    <tr>
                        <th>Nombre</th>
                        <th>Código</th>
                        <th>Raza</th>
                        <th>Raza</th>
                        <th>Etapa</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="animalTableBody">
                   
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>


  document.addEventListener('DOMContentLoaded', function() {
    
    // Función para obtener el ID de la URL
    function getSessionIdFromUrl() {
            const url = window.location.href;
            const parts = url.split('/');
            return parts[parts.length - 1]; // Asumiendo que el ID está al final de la URL
        }

        const sessionId = getSessionIdFromUrl();

    function loadData(){
      let url = ``

    }
  });
</script>