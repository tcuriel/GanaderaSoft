import { ValidatorFactory } from "../validators/ValidatorFactory";
import Swal from 'sweetalert2';

import DataTable from 'datatables.net-dt';
import 'datatables.net-responsive-dt';

let table = new DataTable('#table_id', {
    language: {
      url: '//cdn.datatables.net/plug-ins/2.0.7/i18n/es-ES.json',
    },
    responsive: true
});

// @ts-ignore
const fincaId = JSON.parse(window.dataFinca)[0].id_Finca;
// @ts-ignore
const rebanoId = JSON.parse(window.dataRebano)[0].id_Rebano;
// @ts-ignore
const list_animal_url = window.list_animal;
const selectElement = document.getElementById("herd");
// @ts-ignore
const fincaname = JSON.parse(window.dataFinca)[0].Nombre;
const listAnimal = document.getElementById("listAnimal");
// @ts-ignore
let selectedHerd = (selectElement)?selectElement.value:"";

getDataTable();

// Agregamos un evento "change" al elemento "select"
if(selectElement) selectElement.addEventListener("change", (event) => {
    // @ts-ignore
    const selectedValue = event.target.value;
    selectedHerd = selectedValue;
    getDataTable();
});

function getDataTable() {
  if(fincaId != null && fincaId > 0 && fincaId != undefined && selectedHerd > 0) {
      // @ts-ignore
      const url_action = list_animal_url + fincaId + "/" + selectedHerd + "/Archivado";
      let swal;
      
      swal = Swal.fire({
        title: "Obteniendo datos de " + fincaname + " ...",
        timerProgressBar: true,
        didOpen: () => {
          Swal.showLoading();
        }
      });

      fetch(url_action, {
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
          if (response.status === 500) {
            swal.close();
            Swal.fire({
                icon: "error",
                text: "Error al enviar el formulario.",
                confirmButtonText: "Aceptar"
            });
            // @ts-ignore
            actionButton.disabled = false;
            return; 
          }
          return response.json();
        })
      .then(data => {// Respuesta del servidor
          swal.close();
          if(data) {
            //buildList(data.animales);
            console.log(data);
          }
      })
      .catch(error => {// Error
        
        swal.close();
        swal = Swal.fire({
          icon: "error",
          text: "Error al obtener datos.",
          confirmButtonText: "Aceptar"
        });
    
        console.error("Error al obtener datos:", error);
    
      });

  }
}

function buildList(data) {
    if(data.length > 0 && listAnimal) {
        listAnimal.innerHTML = "";
        data.forEach((element) => {

            const container = document.createElement("div");
            container.classList.add("row", "g-3", "continer-item-list");
          
            const animalInfo = document.createElement("div");
            animalInfo.classList.add("col-7", "mt-0", "iconanimalcow");
          
            const animalTitle = document.createElement("h4");
            animalTitle.classList.add("mb-1");
            const shortNme = element.Nombre.slice(0, 8);
            animalTitle.textContent = shortNme + (shortNme.length < element.Nombre.length ? "..." : ""); 
          
            const buttonContainer = document.createElement("div");
            buttonContainer.classList.add("col-5", "mt-0", "align-content-around", "text-right");
          
            const viewButton = document.createElement("button");
            viewButton.type = "button";
            viewButton.id = "listItem" + element.id_Animal;
            viewButton.classList.add("btn", "btn-secundary", "btn-secundary-darck", "listItem");
            viewButton.textContent = "Ver Animal";
          
            // Append child elements
            animalInfo.appendChild(animalTitle);
            buttonContainer.appendChild(viewButton);
            container.appendChild(animalInfo);
            container.appendChild(buttonContainer); 
            
            // Add the list item to the list
            listAnimal.appendChild(container);

        });// Add a single listener to the parent element (listAnimal)
    
        listAnimal.addEventListener("click", (event) => {
            // @ts-ignore
            const clickedButton = event.target.closest(".listItem"); // "listItem" eventoo click botones
            if (clickedButton) {
                const idAnimal = clickedButton.id.replace("listItem", ""); // Extract id_Animal from ID
                console.log(idAnimal);
            }

        });

    }
}