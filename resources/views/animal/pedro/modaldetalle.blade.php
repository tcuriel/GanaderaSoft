<head>
  <!-- Otros enlaces y meta etiquetas -->
  <link rel="stylesheet" href="{{ asset('assets/css/animal/estilos.css') }}">
</head>


<div class="modal fade" id="animalDetailModal" tabindex="-1" role="dialog" aria-labelledby="animalDetailModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="animalDetailModalLabel">Detalles del Animal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>

      <div class="modal-body" id="modal-body-content">
        <!-- Información General Section -->
        <div class="info-section">
          <h6>Información General</h6>
          <div class="form-group">
            <label for="nombre" class="label-texto">Nombre</label>
            <input type="text" class="input-texto" id="nombre" placeholder="Nombre">
          </div>
          <div class="form-group">
            <label for="edad" class="label-texto">Edad</label>
            <input type="text" class="input-texto" id="edad" placeholder="Edad">
          </div>
          <div class="form-group">
            <label for="raza" class="label-texto">Raza</label>
            <input type="text" class="input-texto" id="raza" placeholder="Raza">
          </div>
          <div class="form-group">
            <label for="procedencia" class="label-texto">Procedencia</label>
            <input type="text" class="input-texto" id="procedencia" placeholder="Procedencia">
          </div>
          <div class="form-group">
            <label for="etapa" class="label-texto">Etapa</label>
            <input type="text" class="input-texto" id="etapa" placeholder="Etapa">
          </div>
          <div class="form-group">
            <label for="peso" class="label-texto">Peso (KG)</label>
            <input type="text" class="input-texto" id="peso" placeholder="Peso">
          </div>
        </div>
        <div id="animalDetails"></div>
      </div>

      <div class="modal-footer">
        <div class="button-container">
          <button class="button-green">
            <i class="fa fa-calendar"></i> Eventos
          </button>
          <button class="button-blue" id="consultar-btn">
            <i class="fa fa-search"></i> Consultar
          </button>
        </div>
      </div>
    </div>
  </div>
</div>



<script>
  document.addEventListener('DOMContentLoaded', function() {
    $('#animalDetailModal').on('show.bs.modal', function (event) {
      const modal = $(this);
      const animalId = modal.attr('data-animal-id');
      console.log('Fetching details for animal ID:', animalId); // Log para depuración

      // Realiza una llamada AJAX para obtener los detalles del animal
      fetch(`/Animal/detalle/${animalId}`)
        .then(response => response.json())
        .then(data => {
          console.log('Data received:', data);

          const animal = data.data[0];
          document.getElementById('nombre').value = animal.Nombre;
          document.getElementById('edad').value = animal.fecha_nacimiento;
          document.getElementById('raza').value = animal.fk_composicion_raza;
          document.getElementById('procedencia').value = animal.Procedencia;
          document.getElementById('etapa').value = animal.Sexo;
          document.getElementById('peso').value = animal.codigo_animal;

          modal.modal('handleUpdate');
        })
        .catch(error => console.error('Error fetching animal details:', error));
    })

  });
</script>

<script>
     // Evento click para el botón Consultar
     document.getElementById('consultar-btn').addEventListener('click', function() {
    const modalBodyContent = document.getElementById('modal-body-content');
    modalBodyContent.innerHTML = `
      <button class="btn detalle-btn d-block mb-2" id="medidas-btn">
        <i class="fas"></i> Medidas Corporales
      </button>
      <button class="btn detalle-btn d-block mb-2">
        <i class="fas"></i> Peso Corporal
      </button>
      <button class="btn detalle-btn d-block mb-2">
        <i class="fas"></i> Índices Corporales
      </button>
      <button class="btn detalle-btn d-block mb-2">
        <i class="fas"></i> Cambios Animal
      </button>
      <button class="btn detalle-btn d-block mb-2">
        <i class="fas"></i> Árbol Genealógico
      </button>
      <p id="animalDetails"></p>
    `;

       // Función para cargar contenido desde un archivo HTML
    function loadContent(url, elementId) {
         // Limpia el contenido del div específico antes de cargar la nueva plantilla
         modalBodyContent.innerHTML = '';
      fetch(url)
        .then(response => response.text())
        .then(data => {
          modalBodyContent.innerHTML = data;
        })
        .catch(error => console.error('Error loading content:', error));
    }

    // Agrega eventos click a los nuevos botones
    document.getElementById('medidas-btn').addEventListener('click', function() {
      loadContent('/medidas', 'animalDetails');
    });

    document.getElementById('peso-btn').addEventListener('click', function() {
      loadContent('peso.html', 'animalDetails');
    });

    document.getElementById('indices-btn').addEventListener('click', function() {
      loadContent('indices.html', 'animalDetails');
    });

    document.getElementById('cambios-btn').addEventListener('click', function() {
      loadContent('cambios.html', 'animalDetails');
    });

    document.getElementById('arbol-btn').addEventListener('click', function() {
      loadContent('arbol.html', 'animalDetails');
    });
  });


</script>