<div>
    <div style="display: flex; align-items: center;">
        <label for="selectView" class="col-sm-33 col-form-label gren-text-color tittle-selector-views" style="margin-right: 15px;">
            ¿Qué deseas ver?
        </label>
        <select id="selectView" class="form-select form-select-lg mb-3" aria-label="Large select example" style="width: 200px; background-color: #C0D43B; color: #0B7509">
            <option value="animal" selected>Animal</option>
            <option value="celo">Celo</option>
            <option value="reproduccion">Reproduccion</option>
        </select>
    </div>

    <div class="form-group row">
                    <label for="herd" class="col-sm-3 col-form-label gren-text-color title-selector-views">Selecciona un Rebaño</label>
                    <div class="col-sm-auto">
                        <select class="form-select"
                            id="rebanoList"
                            name="herd"
                            aria-label="select type Herd"
                            required>
                           
    
                        </select>
                    </div>
                </div>

    <div style="display: flex; justify-content: flex-end;">
        <div class="dt-search" style="margin-top: 60px; margin-left:20px;">
            <label for="dt-search-0">Buscar: </label>
            <input type="search" class="dt-input" id="dt-search-0" placeholder aria-controls="table_id">
        </div>
    </div>

    <div class="container my4">
        <div class="row">
            <div class="col-sm-12 col-md-12">
                <table id="reproduccionTable" class="table" style="width: 1250px; margin-left:50px">
                    <thead id="tableHead">
                       
                    </thead>
                    <tbody id="reproduccionTableBody">
                        <!-- Las filas se agregarán aquí dinámicamente -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
   document.addEventListener('DOMContentLoaded', function() {
    const selectView = document.getElementById('selectView');
    const rebanoList = document.getElementById('rebanoList');

      // Función para obtener el ID de la URL
      function getSessionIdFromUrl() {
            const url = window.location.href;
            const parts = url.split('/');
            return parts[parts.length - 1]; // Asumiendo que el ID está al final de la URL
        }

        const sessionId = getSessionIdFromUrl();


      function loadData(viewType, rebanoId) {
        let url = '';
        let tableHead = document.getElementById('tableHead');
        switch(viewType) {
                case 'animal':
                    url = `/Reproduccion/reproduccion/${rebanoId}/${viewType}`;
                    tableHead.innerHTML = `
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Sexo</th>
                            <th scope="col" style="text-align: center;">Acciones</th>
                        </tr>
                    `;
                    break;
                case 'celo':
                    url = `/Reproduccion/reproduccion/${rebanoId}/${viewType}`;
                    tableHead.innerHTML = `
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Fecha de Celo</th>
                            <th scope="col">Duración</th>
                            <th scope="col" style="text-align: center;">Acciones</th>
                        </tr>
                    `;
                    break;
                case 'reproduccion':
                    url = `/Reproduccion/reproduccion/${rebanoId}/${viewType}`;
                    tableHead.innerHTML = `
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Tipo de Servicio</th>
                            <th scope="col">Fecha de Servicio</th>
                            <th scope="col" style="text-align: center;">Acciones</th>
                        </tr>
                    `;
                    break;
                default:
                    console.error('Tipo de vista no reconocido');
                    return;
            }

        fetch(url)
            .then(response => response.json())
            .then(data => {
                if (data.status === 'OK') {
                    const tbody = document.getElementById('reproduccionTableBody');
                    tbody.innerHTML = ''; // Limpiar el contenido anterior
                    data.data.forEach((item, index) => {
                        const row = document.createElement('tr');
                        switch(viewType) {
                                case 'animal':
                                    const buttonUrl = `/agregarReproduccion/${item.id_Animal}`;
                                    row.innerHTML = `
                                        <td>${index + 1}</td>
                                        <td>${item.Nombre}</td>
                                        <td>${item.Sexo}</td>
                                         <td style="text-align: center;">
                                             <a href="${buttonUrl}" class="btn btn-secondary">Registrar Servicio</a>
                                              <a href="" class="btn btn-secondary">Registrar Celo</a>
                                        </td>
                                        `;
                                    break;
                                case 'celo':
                                    row.innerHTML = `
                                        <td>${index + 1}</td>
                                        <td>${item.Nombre}</td>
                                        <td>${item.Sexo}</td>
                                         <td>${item.servicio_tipo}</td>
                                        <td>${item.servicio_fecha}</td>
                                        <td style="text-align: center;">
                                            <!-- Aquí puedes agregar botones de acción -->
                                        </td>
                                    `;
                                    break;
                                case 'reproduccion':
                                    row.innerHTML = `
                                        <td>${index + 1}</td>
                                        <td>${item.servicio_tipo}</td>
                                        <td>${item.servicio_fecha}</td>
                                        <td style="text-align: center;">
                                            <!-- Aquí puedes agregar botones de acción -->
                                        </td>
                                    `;
                                    break;
                            }
                        tbody.appendChild(row);
                    });
                }
            })
            .catch(error => console.error('Error:', error));
    };


     // Función para cargar datos de los rebaños
     function loadRebanos() {
            fetch(`/Finca/listar-rebano/Activo/${sessionId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'OK') {

                        rebanoList.innerHTML = ''; // Limpiar el contenido anterior
                        data.data.forEach(rebano => {
                            const option = document.createElement('option');
                            option.value = rebano.id_Rebano;
                            option.textContent = rebano.Nombre;
                            rebanoList.appendChild(option);
                        });
                    }
                })
                .catch(error => console.error('Error:', error));
        }

           // Evento para cambiar la vista según la selección
           selectView.addEventListener('change', function() {
            const viewType = selectView.value;
            const rebanoId = rebanoList.value;
            loadData(viewType, rebanoId);
        });

          // Evento para cambiar la vista según el rebaño seleccionado
          rebanoList.addEventListener('change', function() {
            const viewType = selectView.value;
            const rebanoId = rebanoList.value;
            loadData(viewType, rebanoId);
        });

        // Cargar datos iniciales
        loadRebanos();
       // loadData(viewType, rebanoId);
      });
</script>