import { ValidatorFactory } from "../validators/ValidatorFactory";
import Swal from 'sweetalert2';

// @ts-ignore
const fincaId = JSON.parse(window.dataFinca)[0].id_Finca;
// @ts-ignore
const fincaname = JSON.parse(window.dataFinca)[0].Nombre;
// @ts-ignore
const url_actionGetList = window.list_personal;
// @ts-ignore
const url_actionGet = window.get_personal;
const listPersonalUl = document.getElementById("listPersonal");
const personalStatisticsDiv = document.getElementById("personalStatistics");
const personalContenFormDiv = document.getElementById("personalContenForm");
const inputsPatterns = document.querySelectorAll('[data-pattern-input]');
const form = document.getElementById("form_update_personal_farm"); // Obtiene el elemento formulario id

findPersonalLists();

document.addEventListener("DOMContentLoaded", function () {
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]');
    // @ts-ignore
    [...popoverTriggerList].map(popoverTriggerEl => {
        // @ts-ignore
        const popover = new bootstrap.Popover(popoverTriggerEl);
            popoverTriggerEl.addEventListener("click", function () {
                // Ocultar todos los popovers
                [...popoverTriggerList].forEach(triggerEl => {
                if (triggerEl !== popoverTriggerEl) {
                    // @ts-ignore
                    const popoverInstance = bootstrap.Popover.getInstance(triggerEl);
                    popoverInstance.hide();
                }
            });
            // Mostrar el popover actual
            popover.show();

            // Ocultar el popover después de 2 segundos
            setTimeout(() => {
                popover.hide();
            }, 2000);
        });
    });
});

if(fincaId != null && fincaId > 0 && form != null) {
    form.addEventListener("submit", (event) => {

        const url_actionPut = form.getAttribute('action');
        if(url_actionPut != null) {
            event.preventDefault();
            const validador = ValidatorFactory.crearValidador('addPersonalFarm', form);
            validador.validar();
            if (!validador.formularioValido()) {
                validador.obtenerErrores();

                Swal.fire({
                    icon: "info",
                    text: "No se pudo enviar el formulario. Revisa los campos marcados.",
                    confirmButtonText: "Aceptar"
                });

            } else {
                const idnumberPersonal = form.querySelector("#idnumber");
                // @ts-ignore
                let cedula = idnumberPersonal.value.replace(/^[VEJPG|vejpg]-/g, "");
                cedula = cedula.replace(/-[\d]/g, "");
                // @ts-ignore
                const formData = new FormData(form);
                const dataFinca = {
                    personal_finca: {
                        Cedula: formData.get('idnumber') ? formData.get('idnumber') : null,
                        Nombre: formData.get('name') ? formData.get('name') : null,
                        Apellido: formData.get('lastname') ? formData.get('lastname') : null,
                        Telefono: formData.get('phone') ? formData.get('phone') : null,
                        Correo: formData.get('email') ? formData.get('email') : null,
                        Tipo_Trabajador: formData.get('worker') ? formData.get('worker') : null,
                    }
                };
                createData(url_actionPut + cedula + "/" + fincaId, dataFinca);
            }
        }
    });
}

function findPersonalLists() {
    let swal;
    if(fincaId != null && fincaId > 0 && url_actionGetList) {

        swal = Swal.fire({
            title: "Obteniendo datos de " + fincaname + " ...",
            timerProgressBar: true,
            didOpen: () => {
              Swal.showLoading();
            }
        });
    
        fetch(url_actionGetList + fincaId, {
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

    if(data.data.length > 0 && listPersonalUl) {
        listPersonalUl.innerHTML = "";
        data.data.forEach((element) => {
            const listItem = document.createElement("li");
            listItem.classList.add("list-group-item");
      
            const row = document.createElement("div");
            row.classList.add("row", "continer-item-list");
      
            const iconCol = document.createElement("div");
            iconCol.classList.add("col-6", "iconpersonalfarm", "text-center");
      
            const iconTitle = document.createElement("h4");
            iconTitle.classList.add("mb-1");

            const shortNme = element.Nombre.slice(0, 8);
            iconTitle.textContent = shortNme + (shortNme.length < element.Nombre.length ? "..." : ""); 
            iconCol.appendChild(iconTitle);
      
            const buttonCol = document.createElement("div");
            buttonCol.classList.add("col-6");
      
            const listButton = document.createElement("button");
            listButton.type = "button";
            listButton.classList.add("btn", "btn-secundary", "btn-secundary-darck", "float-right", "listItem");
            listButton.textContent = "Ver Personal"; // Button text
            listButton.id = "listItem" + element.id_Tecnico;
      
            buttonCol.appendChild(listButton);
      
            row.appendChild(iconCol);
            row.appendChild(buttonCol);
      
            listItem.appendChild(row);
            listPersonalUl.appendChild(listItem);
        });

        listPersonalUl.addEventListener("click", (event) => {

            let swal;
            // @ts-ignore
            const clickedButton = event.target.closest(".listItem"); // "listItem" eventoo click botones
            if (clickedButton) {
              
                const idPersonal = clickedButton.id.replace("listItem", ""); // Extract id_Rebano from ID

                fetch(url_actionGet + idPersonal, {
                        method: "GET",
                        headers: {
                        "Content-Type": "application/json",
                    }
                })
                .then(response => {
                    if (response.status === 204) {
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
                    if(data) {
                        buildForm(data.data);
                    }
                })
                .catch(error => {// Error
                    Swal.fire({
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
 * @param {Element} input
 */
function getPattern(input) {
    const patternString = input.getAttribute("data-pattern");
    // Validate patternString
    if (!patternString || !patternString.trim()) {
      throw new Error("Invalid pattern string: Empty or missing.");
    }
  
    try {
      return new RegExp(patternString);
    } catch (error) {
      throw new Error(`Invalid pattern string: ${error.message}`);
    }
}

let oldValue=null;
if (inputsPatterns) inputsPatterns.forEach(input => {
    input.addEventListener('input', (e) => {
        if (e.target instanceof HTMLInputElement) {
          const valor = e.target.value;
          const pattern = getPattern(input);
      
          if (typeof pattern !== 'object' || !(pattern instanceof RegExp)) {
            console.error('El patrón no es un objeto RegExp válido');
            return;
          }
      
          // Si el valor completo no coincide con el patrón
          if (!pattern.test(valor)) {
            // Elimina solo el último carácter que violó el patrón
            e.target.value = valor.slice(0, -1);
          } else {
            oldValue = valor;
          }
        }
    });

  input.addEventListener('focusin', () => {
    oldValue=null;
  });

});

function buildForm(data) {
    if(form != null) {
        // @ts-ignore
        personalStatisticsDiv.style.display = "none";
        // @ts-ignore
        personalContenFormDiv.style.display = "block";

        const tNameH2 = form.querySelector("#tName");
        // @ts-ignore
        if (tNameH2 != null) tNameH2.textContent = data.Nombre ?? "";
        // @ts-ignore
        //if (tNameH2 != null) tNameH2.textContent = data.Nombre ?? "";
        const idnumberPersonal = form.querySelector("#idnumber");
        // @ts-ignore
        if (idnumberPersonal != null) idnumberPersonal.value = data.Cedula ?? "";
        const namePersonal = form.querySelector("#name");
        // @ts-ignore
        if (namePersonal != null) namePersonal.value = data.Nombre ?? "";
        const lastnamePersonal = form.querySelector("#lastname");
        // @ts-ignore
        if (lastnamePersonal != null) lastnamePersonal.value = data.Apellido ?? "";
        const phonePersonal = form.querySelector("#phone");
        // @ts-ignore
        if (phonePersonal != null) phonePersonal.value = data.Telefono ?? "";
        const emailPersonal = form.querySelector("#email");
        // @ts-ignore
        if (emailPersonal != null) emailPersonal.value = data.Correo ?? "";
        const workerPersonal = form.querySelector("#worker");
        // @ts-ignore
        if (workerPersonal != null) workerPersonal.value = data.Tipo_Trabajador ?? "";
    }
}

function createData(url_action, dataFinca) {
    const actionButton = document.getElementById("fincaPersonalSave");
    let swal;
    // @ts-ignore
    actionButton.disabled = true;
    swal = Swal.fire({
        title: "Guardando...",
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading();
        }
    });

    fetch(url_action, {
        method: "PUT",
        headers: {
        "Content-Type": "application/json",
        },
        mode: "cors",
        cache: "default",
        body: JSON.stringify(dataFinca)
    })
    .then(response => response.json())
    .then(data => {// Respuesta del servidor

        swal.close();
        Swal.fire({
            icon: "success",
            text: "Personal modificado exitosamente, presiona ‘Confirmar’ para acceder a tu Personal.",
            confirmButtonText: "Confirmar"
        }).then((result) => {
            if (result.isConfirmed || result.isDismissed) {
                window.location.replace('/dashboard/finca/personal/'+ fincaId);
            }
        });

        // @ts-ignore
        actionButton.disabled = false;
        console.log("Formulario enviado correctamente", data);

    })
    .catch(error => {// Error

        swal.close();
        Swal.fire({
            icon: "error",
            text: "Error al enviar el formulario.",
            confirmButtonText: "Aceptar"
        });

        // @ts-ignore
        actionButton.disabled = false;
        console.error("Error al enviar el formulario:", error);

    });
}
