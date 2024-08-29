

<div class="row">
    <div class="col-12">
        <a href="{{ route('home') }}" class="gren-text-color font-weight-bold float-right my-3 d-block">Listado de fincas</a>
    </div>

    <div class="col-6 mb-3">
        <div class="d-flex align-items-center">
            <label for="selectView" class="col-form-label gren-text-color tittle-selector-views mr-3">
                ¿Qué deseas ver?
            </label>
            <select id="selectView" class="form-select form-select-lg" aria-label="Large select example" style="width: 200px; background-color: #C0D43B; color: #0B7509">
                <option value="animal" selected>Animal</option>
            </select>
        </div>
        <div class="d-flex align-items-center mt-3">
            <label for="herd" class="col-form-label gren-text-color title-selector-views mr-3">
                Selecciona un Rebaño
            </label>
            <select class="form-select form-select-lg" aria-label="Large select example" style="width: 200px; background-color: #C0D43B; color: #0B7509" id="rebanoList" name="herd" required>
            </select>
        </div>
    </div>

    <div class="col-6 d-flex flex-column align-items-end mb-3">
        <a href="{{url('/finca/animal/agregar/'.$data[0]->id_Finca)}}" id="addRebano" class="btn btn-primary btn-primary-darck mb-2">Agregar Animal <i class="fas fa-fw fa-plus"></i></a>
        @if(!empty($listRebano))
        <a href="{{url('/finca/rebano/'.$data[0]->id_Finca.'/up/'.$listRebano[0]->id_Rebano)}}" id="addRebanoLot" class="btn btn-primary btn-primary-darck">Subir Animales <i class="fas fa-fw fa-plus"></i></a>
        @endif
    </div>
</div>




    <div class="container my4">
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <table id="animalTable" class="table" style="width: 1250px; margin-left:50px">
                <thead id="tableHead">
                    <!-- Aquí puedes agregar tus encabezados de tabla -->
                </thead>
                <tbody id="animalTableBody">
                    <!-- Las filas se agregarán aquí dinámicamente -->
                </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center" id="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</div>

<!-- Incluir el modal -->
@include('animal.modaldetalle')

</div>


<script>
 document.addEventListener('DOMContentLoaded', function() {
    const selectView = document.getElementById('selectView');
    const rebanoList = document.getElementById('rebanoList');

    //parte de paginacion
    const rowsPerPage = 5; // Número de filas por página
    let currentPage = 1;
    let data = []; // Aquí se almacenarán los datos obtenidos del fetch
    // -------------------------
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
                    url = `/Animal/animales/${rebanoId}`;
                    tableHead.innerHTML = `
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">Etapa</th>
                            <th scope="col">Sexo</th>
                            <th scope="col">Fecha de Nacimiento</th>
                            <th scope="col" style="text-align: center;">Acciones</th>
                        </tr>
                    `;
                    break;
                  default:

                  break;
                }

                fetch(url)
        .then(response => response.json())
        .then(result => {
            if (result.status === 'OK') {
                data = result.data;
                displayPage(currentPage);
                setupPagination();
            }
        });

        function displayPage(page) {
    const tbody = document.getElementById('animalTableBody');
    tbody.innerHTML = ''; // Limpiar el contenido anterior
    const start = (page - 1) * rowsPerPage;
    const end = start + rowsPerPage;
    const pageData = data.slice(start, end);

    pageData.forEach((item, index) => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${item.id_Animal}</td>
            <td>${item.Nombre}</td>
            <td>${item.etapa_nombre}</td>
            <td>${item.Sexo}</td>
            <td>${item.fecha_nacimiento}</td>
            <td style="text-align: center;">
                <button class="btn btn-secondary detalle-btn" data-id="${item.id_Animal}" data-bs-toggle="modal" data-bs-target="#animalDetailModal">
                    Detalle
                </button>
            </td>
        `;
        tbody.appendChild(row);
    });

    // Configurar eventos de clic para los botones "Detalle"
    const detalleButtons = document.querySelectorAll('.detalle-btn');
    detalleButtons.forEach(button => {
        button.addEventListener('click', function () {
            const animalId = this.getAttribute('data-id');

            // Verifica si el animalId es válido
            if (animalId) {
                document.getElementById('animalDetailModal').setAttribute('data-animal-id', animalId);
                        
                $('#animalDetailModal').modal('show');
            } else {
                console.error('Animal ID is undefined');
            }
        });
    });
}


    function setupPagination() {
    const pagination = document.getElementById('pagination');
    pagination.innerHTML = ''; // Limpiar el contenido anterior
    const totalPages = Math.ceil(data.length / rowsPerPage);

    // Botón "Anterior"
    const prevButton = document.createElement('li');
    prevButton.classList.add('page-item');
    prevButton.innerHTML = `
        <a class="page-link" href="#" aria-label="Previous">
            <span aria-hidden="true">&laquo;</span>
        </a>
    `;
    prevButton.addEventListener('click', () => {
        if (currentPage > 1) {
            currentPage--;
            displayPage(currentPage);
        }
    });
    pagination.appendChild(prevButton);

    // Botones de página
    for (let i = 1; i <= totalPages; i++) {
        const button = document.createElement('li');
        button.classList.add('page-item');
        button.innerHTML = `<a class="page-link" href="#">${i}</a>`;
        button.addEventListener('click', () => {
            currentPage = i;
            displayPage(currentPage);
        });
        pagination.appendChild(button);
    }

    // Botón "Siguiente"
    const nextButton = document.createElement('li');
    nextButton.classList.add('page-item');
    nextButton.innerHTML = `
        <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span>
        </a>
    `;
    nextButton.addEventListener('click', () => {
        if (currentPage < totalPages) {
            currentPage++;
            displayPage(currentPage);
        }
    });
    pagination.appendChild(nextButton);
}
}

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
                         // Cargar datos iniciales del primer rebaño en la lista
                    if (rebanoList.options.length > 0) {
                        const firstRebanoId = rebanoList.options[0].value;
                        loadData('animal', firstRebanoId);
                    }
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
    });

</script>
