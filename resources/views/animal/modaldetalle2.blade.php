<head>
  <!-- Otros enlaces y meta etiquetas -->
  <link rel="stylesheet" href="{{ asset('assets/css/animal/estilos.css') }}">
  <style>
    @media (min-width: 768px) {
      .modal-dialog {
        width: 60vw;
      }
    }

    @media (max-width: 767px) {
      .modal-dialog {
        width: 90vw;
      }
    }
  </style>
</head>

<!-- Modal 1 Detallas del Animal -->
<!--div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="modal1Label" aria-hidden="true"-->
<!--div class="modal fade" id="modal1" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true"-->
<div class="modal fade" id="animalDetailModal" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="animalDetailModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" style="width: 80vw;">
    <div class="modal-content">
      <div class="modal-header">  
        <h5 class="modal-title" id="animalDetailModalLabel">
          <button type="button" class="btn" data-dismiss="modal">
          <i class="fa fa-arrow-left" aria-hidden="true"></i>
          </button>
          Detalles del Animal: [NOMBRE DEL ANIMAL]
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
        <div class="container">

          <div class="row">
            <div class="col-md-12 text-center">
              <h5>Información General</h5>
            </div>
          </div>

          <!-- Primera fila -->
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Nombre</label>
                <input type="hidden" id="id_Animal">
                <input type="text" id="nombre" class="form-control" placeholder="">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Peso (KG)</label>
                <input type="text"  id="edad" class="form-control" placeholder="">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Raza</label>
                <input type="text" id="raza" class="form-control" placeholder="">
              </div>
            </div>
          </div>

          <!-- Segunda fila -->
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Información Animal</label>
                <input type="text" id="procedencia" class="form-control" placeholder="">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Información Animal</label>
                <input type="text" id="etapa" class="form-control" placeholder="">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Información Animal</label>
                <input type="text" id="peso" class="form-control" placeholder="">
              </div>
            </div>
          </div>

          <!-- Tercera fila -->
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1"><b>Medidas Corporales</b><br>Medidas Corporales</label>
                <input type="text" class="form-control" placeholder="">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1"><b>Índice Corporales</b><br>Índice Corporales</label>
                <input type="text" class="form-control" placeholder="">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1"><b>Etapa de Crecimiento</b><br>Etapa de Crecimiento</label>
                <input type="text" class="form-control" placeholder="">
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <div class="button-container">
          <button class="button-green">
            <i class="fa fa-calendar"></i> Eventos
          </button>
          <button class="button-blue" 
                  id="consultar-btn"
                  data-id="${item.id_Animal}" 
                  data-toggle="modal" data-target="#modal2">
            <i class="fa fa-search"></i> Consultar
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal 2 Detallas del Animal "Otros aspectos" -->
<div class="modal fade" id="modal2" tabindex="-1" aria-labelledby="modal2Label" aria-hidden="true"-->
  <div class="modal-dialog modal-lg modal-dialog-centered" style="width: 80vw;">  
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="animalDetailModalLabel">
          <button type="button" class="btn" data-dismiss="modal">
          <i class="fa fa-arrow-left" aria-hidden="true"></i>
          </button>
          Detalles del Animal (Otros aspectos): [NOMBRE DEL ANIMAL]
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <button class="btn d-block mb-2" 
          id="medidas-btn" data-toggle="modal" data-target="#modal3">
          <i class="fa fa-circle"></i> Medidas Corporales
        </button>
        <button class="btn detalle-btn d-block mb-2">
          <i class="fa fa-circle"></i> Peso Corporal
        </button>
        <button class="btn detalle-btn d-block mb-2">
          <i class="fa fa-circle"></i> Índices Corporales
        </button>
        <button class="btn detalle-btn d-block mb-2">
          <i class="fa fa-circle"></i> Cambios Animal
        </button>
        <button class="btn detalle-btn d-block mb-2">
          <i class="fa fa-circle"></i> Árbol Genealógico
        </button>
        <p id="animalDetails"></p>
      </div>
      <div class="modal-footer">
        <!--button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal3">Siguiente</button-->
        <div class="button-container">
          <button class="button-green">
            <i class="fa fa-folder"></i> Archivar
          </button>
          <button class="button-blue" id="consultar-btn" data-toggle="modal" data-target="#modal2">
            <i class="far fa-edit"></i> Modificar
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal 3 Detallas del Animal "Aspectos en particular: " -->
<div class="modal fade" id="modal3" tabindex="-1" aria-labelledby="modal3Label" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" style="width: 80vw;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="animalDetailModalLabel">
          <button type="button" class="btn" data-dismiss="modal">
          <i class="fa fa-arrow-left" aria-hidden="true"></i>
          </button>
          Medidas Corporales (Actuales): [NOMBRE DEL ANIMAL]
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="container">

          <div class="row">
            <div class="col-md-12 text-center">
              <h5>Medidas Corporales (Actuales)</h5>
            </div>
          </div>

          <!-- Primera fila -->
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Altura HC</label>
                <input type="hidden" id="id_Animal">
                <input type="text" id="nombre" class="form-control" placeholder="">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Altura HG</label>
                <input type="text"  id="edad" class="form-control" placeholder="">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Perimetro PT</label>
                <input type="text" id="raza" class="form-control" placeholder="">
              </div>
            </div>
          </div>

          <!-- Segunda fila -->
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Perimetro PCA</label>
                <input type="text" id="procedencia" class="form-control" placeholder="">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Longitud LC</label>
                <input type="text" id="etapa" class="form-control" placeholder="">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Longitud LG</label>
                <input type="text" id="peso" class="form-control" placeholder="">
              </div>
            </div>
          </div>

          <!-- Tercera fila -->
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="exampleInputEmail1">Anchura AG</label>
                <input type="text" class="form-control" placeholder="">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
               </div>
            </div>
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <!--button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button-->
        <div class="button-container">
          <button class="button-green">
            <i class="fa fa-folder"></i> Agregar
          </button>
          <button class="button-blue">
            <i class="far fa-edit"></i> Actualizar
          </button>
          <button class="button-blue">
            <i class="far fa-edit"></i> Eliminar
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

          document.getElementById('id_Animal').value = animalId;

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
    
    const modalBodyContent = document.getElementById('modal2');
    console.log(modalBodyContent);
    const animalId = document.getElementById('id_Animal').value;
    console.log('[' + animalId + ']');
    /*modalBodyContent.innerHTML = `
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
    `;*/

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
      //loadContent('/medidas', 'animalDetails');
      console.log('clic: medidas-btn')
    });

/*
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
*/

  });

</script>
