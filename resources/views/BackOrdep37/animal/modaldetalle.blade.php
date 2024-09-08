<div class="modal fade" id="animalDetailModal" tabindex="-1" role="dialog" aria-labelledby="animalDetailModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="animalDetailModalLabel">Detalles del Animal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Aquí puedes ajustar el contenido del modal -->
        <p id="animalDetails"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
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
      fetch(`/animal/${animalId}`)
        .then(response => response.json())
        .then(data => {
          console.log('Animal data:', data); // Log para depuración
          // Actualiza el contenido del modal con los detalles del animal
          document.getElementById('animalDetails').innerText = `
            Nombre: ${data.Nombre}
            Etapa: ${data.etapa_nombre}
            Sexo: ${data.Sexo}
            Fecha de Nacimiento: ${data.fecha_nacimiento}
          `;
        })
        .catch(error => console.error('Error fetching animal details:', error));
    });
  });

</script>
