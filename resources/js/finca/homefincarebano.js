import Swal from 'sweetalert2';

// @ts-ignore
const fincaId = JSON.parse(window.dataFinca)[0].id_Finca;
// @ts-ignore
const fincaname = JSON.parse(window.dataFinca)[0].Nombre;
// @ts-ignore
const url_actionGetList = window.list_rebano;
// @ts-ignore
const url_actionGet = window.get_rebano;
const selectStatusRebanoFarm = document.getElementById("selectStatusRebanoFarm");
const listRebanoUl = document.getElementById("listRebano");
const form = document.getElementById("form_rebano_farm"); // Obtiene el elemento formulario id
const rebanoStatisticsDiv = document.getElementById("rebanoStatistics");
const rebanoContenFormDiv = document.getElementById("rebanoContenForm");
let swal;

findRebanoLists();

if (selectStatusRebanoFarm) selectStatusRebanoFarm.addEventListener("change", (event) => {
  // @ts-ignore
  const tipoListado = event.target.value;
  if(tipoListado != null) {
    findRebanoLists(tipoListado);
  }
});

function findRebanoLists(tipoListado = "Activo") {
  if(fincaId != null && fincaId > 0 && url_actionGetList) {
    swal = Swal.fire({
        title: "Obteniendo datos de " + fincaname + " ...",
        timerProgressBar: true,
        didOpen: () => {
          Swal.showLoading();
        }
    });

    fetch(url_actionGetList + tipoListado + "/" + fincaId, {
        method: "GET",
        headers: {
          "Content-Type": "application/json",
        }
      })
      .then(response => {
        if (response.status === 204) {
          swal.close();
          Swal.fire({
            icon: "info",
            text: "No se encontraron datos.",
            confirmButtonText: "Aceptar"
          });
          return; 
        }
        return response.json();
      })
      .then(data => {// Respuesta del servidor
        swal.close();
        if(data) {
          buildList(data);
        }
      })
      .catch(error => {// Error

        swal.close();
        swal = Swal.fire({
          icon: "error",
          text: "Error al obtener el datos.",
          confirmButtonText: "Aceptar"
        });
    
        console.error("Error al obtener lista rebanos:", error);
      });
  }
}

/**
 * @param {{ data: any[]; }} data
 */
function buildList(data) {
  if(data.data.length > 0 && listRebanoUl) {
    listRebanoUl.innerHTML = "";
    data.data.forEach((/** @type {{ Nombre: string | any[]; id_Rebano: string; }} */ element) => {
      const listItem = document.createElement("li");
      listItem.classList.add("list-group-item");

      // Create inner container
      const containerDiv = document.createElement("div");
      containerDiv.classList.add("row", "continer-item-list");

      const iconAnimalCowDiv = document.createElement("div");
      iconAnimalCowDiv.classList.add("col-7", "iconanimalcow", "text-center");
      const iconH4 = document.createElement("h4");
      iconH4.classList.add("mb-1");

      const shortNme = element.Nombre.slice(0, 8);
      iconH4.textContent = shortNme + (shortNme.length < element.Nombre.length ? "..." : ""); 
      const iconAnimalCowP = document.createElement("p");
      iconAnimalCowP.classList.add("mb-1");
      iconAnimalCowP.textContent = "Animales";// Cantidad de animales
      iconAnimalCowDiv.appendChild(iconH4);
      iconAnimalCowDiv.appendChild(iconAnimalCowP);

      // Button element
      const buttonDiv = document.createElement("div");
      buttonDiv.classList.add("col-5");
      const listItemButton = document.createElement("button");
      listItemButton.type = "button";
      listItemButton.id = "listItem" + element.id_Rebano;
      listItemButton.classList.add("btn", "btn-secundary", "btn-secundary-darck", "float-right", "listItem");
      listItemButton.textContent = "Ver Rebaño";
      buttonDiv.appendChild(listItemButton);

      // Assemble the structure
      containerDiv.appendChild(iconAnimalCowDiv);
      containerDiv.appendChild(buttonDiv);
      listItem.appendChild(containerDiv);

      // Add the list item to the list
      listRebanoUl.appendChild(listItem);
    });    // Add a single listener to the parent element (listRebanoUl)
    
    listRebanoUl.addEventListener("click", (event) => {
      // @ts-ignore
      const clickedButton = event.target.closest(".listItem"); // "listItem" eventoo click botones
      if (clickedButton) {
        
        const idRebano = clickedButton.id.replace("listItem", ""); // Extract id_Rebano from ID

        fetch(url_actionGet + idRebano, {
          method: "GET",
          headers: {
            "Content-Type": "application/json",
          }
        })
        .then(response => {
          if (response.status === 204) {
            swal.close();
            Swal.fire({
              icon: "info",
              text: "No se encontraron datos.",
              confirmButtonText: "Aceptar"
            });
            return; 
          }
          return response.json();
        })
        .then(data => {// Respuesta del servidor
          swal.close();
          if(data) {
            buildForm(data.data);
          }
        })
        .catch(error => {// Error
  
          swal.close();
          swal = Swal.fire({
            icon: "error",
            text: "Error al obtener el datos.",
            confirmButtonText: "Aceptar"
          });
      
          console.error("Error al obtener rebano:", error);
        });
        
      }
    });

  }

}

/**
 * @param {{ Nombre: string; }} data
 */
function buildForm(data) {
  if(form != null) {
    // @ts-ignore
    rebanoStatisticsDiv.style.display = "none";
    // @ts-ignore
    rebanoContenFormDiv.style.display = "block";
    const tNameH2 = form.querySelector("#tName");
    // @ts-ignore
    if (tNameH2 != null) tNameH2.textContent = data.Nombre ?? "";
    const nameRebano = form.querySelector("#name");
    // @ts-ignore
    if (nameRebano != null) nameRebano.value = data.Nombre ?? "";
  }
}

