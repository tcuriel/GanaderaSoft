<head>
  <!-- Otros enlaces y meta etiquetas -->
  <link rel="stylesheet" href="{{ asset('assets/css/animal/estilos.css') }}">
</head>

<div>
  <h6>Medidas Corporales (Actuales)</h6>
 
  <div class="form-group">
            <label for="nombre" class="label-texto">Altura HC</label>
            <input type="text" class="input-texto" id="nombre" placeholder="Nombre">
          </div>
          <div class="form-group">
            <label for="edad" class="label-texto">Altura HG</label>
            <input type="text" class="input-texto" id="edad" placeholder="Edad">
          </div>
          <div class="form-group">
            <label for="raza" class="label-texto">Perimetro PT</label>
            <input type="text" class="input-texto" id="raza" placeholder="Raza">
          </div>
          <div class="form-group">
            <label for="raza" class="label-texto">Perimetro PCA</label>
            <input type="text" class="input-texto" id="raza" placeholder="Raza">
          </div>
          <div class="form-group">
            <label for="raza" class="label-texto">Longitud LC</label>
            <input type="text" class="input-texto" id="raza" placeholder="Raza">
          </div>
          <div class="form-group">
            <label for="raza" class="label-texto">Longitud LG</label>
            <input type="text" class="input-texto" id="raza" placeholder="Raza">
          </div>
          <div class="form-group">
            <label for="raza" class="label-texto">Anchura AG</label>
            <input type="text" class="input-texto" id="raza" placeholder="Raza">
          </div>

    <h6> Medidas Corporales (Historicos)</h6>
    <div id="historico-container">
  <label for="historico-select">Selecciona una fecha:</label>
  <select id="historico-select">
    <option value="27-02-2024">27-02-2024</option>
    <option value="07-09-2023">07-09-2023</option>
    <option value="17-12-2023">17-12-2023</option>
    <option value="22-07-2023">22-07-2023</option>
    <option value="10-11-2023">10-11-2023</option>
    <option value="20-04-2023">20-04-2023</option>
  </select>
  <div id="historico-details"></div>
</div>

</div>
