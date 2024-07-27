import { ValidatorFactory } from "../validators/ValidatorFactory";
import Swal from 'sweetalert2';

const inputsPatterns = document.querySelectorAll('[data-pattern-input]');
const submitButton = document.querySelector(".submit");
// @ts-ignore
const fincaId = JSON.parse(window.dataFinca)[0].id_Finca;

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
                    // @ts-ignore
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

/**
 * @param {{ [s: string]: any; } | ArrayLike<any>} jsonData
 */
function filterNullValues(jsonData) {
    const filteredObj = {};
    for (const [key, value] of Object.entries(jsonData)) {
      if (value !== null) {
        if (typeof value === 'object') {
          filteredObj[key] = filterNullValues(value);
        } else {
          filteredObj[key] = value;
        }
      }
    }
    return filteredObj;
}
/**
 * @param {{ [s: string]: any; } | ArrayLike<any>} jsonData
 */
function removeEmptyObjects(jsonData) {
    const filteredObj = {};
    for (const [key, value] of Object.entries(jsonData)) {
      if (Object.keys(value).length > 0) {
        filteredObj[key] = value;
      }
    }
    return filteredObj;
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

if(submitButton) submitButton.addEventListener("click", (event) => {

    event.preventDefault(); // Evitar el envío de formulario
    const form = document.getElementById("form_create_animal"); // Obtiene el elemento formulario id

    if(form != null) {
        const url_action = form.getAttribute('action');
        // @ts-ignore
        const formData = new FormData(form);
        const timestamp = Date.now();
        const currentDate = new Date(timestamp);
        const ageString = formData.get('age');
        let ageInt = 0;
        if(ageString != null) {
          // @ts-ignore
          ageInt = parseInt(ageString,10);
        } 
        const jsonData = {
            animal: {
                Nombre: formData.get('name') ? formData.get('name') : null,
                Sexo: formData.get('sex') ? formData.get('sex') : null,
                Edad: ageInt,
                Tipo: formData.get('type') ? formData.get('type') : null,
                Estado: formData.get('state') ? formData.get('state') : null,
                Etapa: formData.get('stage') ? formData.get('stage') : null,
                Procedencia: formData.get('origin') ? formData.get('origin') : null,
            },
            peso: {
              Fecha_Peso: currentDate.toLocaleDateString('es-VE'),
              Peso: 0.01,
              Tipo: "Actual"
            }
        };
        const jsonDataSinNull = filterNullValues(jsonData);
        const filteredJson = removeEmptyObjects(jsonDataSinNull);
        const validador = ValidatorFactory.crearValidador('CreateAnimal', form);
        validador.validar();
        if (!validador.formularioValido()) {
          validador.obtenerErrores();
          
          Swal.fire({
            icon: "info",
            text: "No se pudo enviar el formulario. Revisa los campos marcados.",
            confirmButtonText: "Aceptar"
          });
    
        } else {
            if(url_action != null) {

                const actionButtons = document.querySelectorAll(".action");// Desactivar todos los botones de accion
                let swal;
                // @ts-ignore
                actionButtons.forEach(button => button.disabled = true);
        
                swal = Swal.fire({
                  title: "Guardando...",
                  timerProgressBar: true,
                  didOpen: () => {
                    Swal.showLoading();
                  }
                });

                fetch(url_action + formData.get('herd'), {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    mode: "cors",
                    cache: "default",
                    body: JSON.stringify(filteredJson)
                    })
                    .then(response => {
                      if (response.status === 400) {
                        // @ts-ignore
                          swal.close();
                          Swal.fire({
                              icon: "info",
                              text: "Los datos no coinciden, verifique si el tipo de animal coincide con su etapa o edad.",
                              confirmButtonText: "Aceptar"
                          });
                      }
                      if (response.status === 500) {
                        // @ts-ignore
                          swal.close();
                          Swal.fire({
                            icon: "error",
                            text: "Error al enviar el formulario.",
                            confirmButtonText: "Aceptar"
                          });
                      }
                      if (response.status === 201) {
                          // @ts-ignore
                          swal.close();
                          Swal.fire({
                              icon: "success",
                              text: "Animal agregado exitosamente, presiona ‘Confirmar’ para acceder a las diversas Gestiones de tu Finca",
                              confirmButtonText: "Confirmar"
                          }).then((result) => {
                              if (result.isConfirmed || result.isDismissed) {
                                  window.location.replace('/dashboard/animal/animal/'+ fincaId);
                              }
                          });
                      }
                      // @ts-ignore
                      actionButtons.forEach(button => button.disabled = false);
                      return response.json();
                    })
                    .catch(error => {// Error

                    // @ts-ignore
                    swal.close();
                    Swal.fire({
                        icon: "error",
                        text: "Error al enviar el formulario.",
                        confirmButtonText: "Aceptar"
                    });

                    // @ts-ignore
                    actionButtons.forEach(button => button.disabled = false);
                    console.error("Error al enviar el formulario:", error);

                    });
                
            }
        }
    }
});