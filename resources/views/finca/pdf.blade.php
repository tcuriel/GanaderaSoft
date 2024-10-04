<!DOCTYPE html>
<html lang="en">
<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit-no">

    <!-- Bootstrap CSS v4.6.2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <style>
      .cabecera {
        background-color: black;
        color: white;
      }
      .texto-centrado {
        text-align: center;
      }
      .contenedor-tabla {
        width: 100%; /* Ocupa todo el ancho disponible */
      }

      table {
        width: 100%; /* Ocupa todo el ancho del contenedor */
        height: 100vh; /* Ocupa al menos la altura de la viewport */
        border-collapse: collapse; /* Elimina los espacios entre celdas */
      }
      img {
        width: 64px; /* Ajusta el ancho de la imagen */
        height: 64px; /* Mantiene la proporción de la imagen */
        /*margin-right: 20px; /* Agrega un margen derecho a la imagen */
      }

      p {
        text-align: justify; /* Justifica el texto */
        color: #218EBC;
        font-size: 16pt;
      }
    </style>
</head>

<body>
    <header>
        <!-- place navbar here -->

        <div style="display: flex;">
          <img src="images/VACA-1_1_64.png" 
               alt="Mi imagen">
               <p>GanaderaSoft</p>
        </div>
        
        <h1 class="texto-centrado">Fincas</h1>
    </header>
    <main class="contenedor-tabla">
        <table class="table" style="">
            <thead class="cabecera">
                <tr>
                  <th scope="col">Id</th>
                  <th scope="col">Propietario</th>
                  <th scope="col">Nombre</th>
                  <th scope="col">Explotacion</th>
                  <th scope="col">Archivado</th>
                </tr>
            </thead>
            <tbody>
            @php
						  $i = 0;
						@endphp
						@foreach ($fincas as $finca)
								@php
										$i++;
										//$finca = (object)$finca;
								@endphp
								<tr>
										<td>{{ $finca->id_Finca }}</td>
                    <td>{{ $finca->nombre_propietario }}</td>
                    <td>{{ $finca->Nombre }}</td>
                    <td>{{ $finca->Explotacion_Tipo }}</td>
                    @if ($finca->archivado == 0)
                    <td>{{ 'No' }}</td>
                    @else
                    <td>{{ 'Si' }}</td>
                    @endif
                    
                </tr>
            @endforeach
            </tbody>
        </table>
    </main>
    <footer>
        <!-- place footer here -->
    </footer>
    <!-- Bootstrap JavaScript Libraries-->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js" integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+" crossorigin="anonymous"></script>
</body>

</html>