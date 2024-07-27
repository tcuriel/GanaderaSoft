import { ValidatorFactory } from "../validators/ValidatorFactory";
import Swal from 'sweetalert2';

const steps = document.querySelectorAll(".step");
const nextButton = document.querySelector(".next");
const backButton = document.querySelector(".back");
const backtobackButton = document.querySelector(".backtoback");
const submitButton = document.querySelector(".submit");
const inputsNumbers = document.querySelectorAll('[data-numbers-only]');

let currentStep = 1;
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

function getPattern(input) {
  const patternString = input.getAttribute("data-pattern");
  return new RegExp(patternString);  // Crear un objeto RegExp a partir de la cadena
}

function showStep(stepNumber) {
  steps.forEach((step, index) => {
    // @ts-ignore
    if(step) step.style.display = index === stepNumber - 1 ? "flex" : "none";
  });
}

function hideButtons(step) {
  const limit = steps.length;
  const actionButtons = document.querySelectorAll(".action");
  // @ts-ignore
  actionButtons.forEach(button => button.style.display = "none");

  if (step < limit && nextButton) {// Muestra el botón "Siguiente"
    // @ts-ignore
    nextButton.style.display = "inline";
  }

  if (step > 1 && backButton && backtobackButton) {// Muestra el botón "Regresar"
    // @ts-ignore
    backButton.style.display = "inline";
    // @ts-ignore
    backtobackButton.style.display = "none";
  }else{
    // @ts-ignore
    backtobackButton.style.display = "inline";
  }

  if (step === limit && nextButton && submitButton) {// Oculta el botón "Siguiente" y muestra el botón "Enviar"
    // @ts-ignore
    nextButton.style.display = "none";
    // @ts-ignore
    submitButton.style.display = "inline";
  }
}

// Muestra el primer paso al iniciar
showStep(currentStep);
hideButtons(currentStep);

// Listener para el botón "Siguiente"
if(nextButton) nextButton.addEventListener("click", () => {
  currentStep++;
  showStep(currentStep);
  hideButtons(currentStep);
});

// Listener para el botón "Atrás"
if(backButton) backButton.addEventListener("click", () => {
  currentStep--;
  showStep(currentStep);
  hideButtons(currentStep);
});

// Listener para el botón "Enviar" (opcional)
if(submitButton) submitButton.addEventListener("click", (event) => {

  event.preventDefault(); // Evitar el envío de formulario
  const form = document.getElementById("form_create_farm"); // Obtiene el elemento formulario id

  if(form != null) {

    const url_action = form.getAttribute('action');
    // @ts-ignore
    const formData = new FormData(form);
    const jsonData = {
      finca: {
        Nombre: formData.get('name') ? formData.get('name') : null,
        Explotacion_Tipo: formData.get('exploitation') ? formData.get('exploitation') : null,
      },
      hierro: {
        //Hierro_Imagen: formData.get('img-iron-show') ? formData.get('img-iron-show') : null,
        //Hierro_QR: formData.get('qr-iron-show') ? formData.get('qr-iron-show') : null,
        identificador: formData.get('idiron') ? formData.get('idiron') : null,
      },
      terreno: {
        Superficie: formData.get('surface') ? formData.get('surface') : null,
        Relieve: formData.get('relief') ? formData.get('relief') : null,
        Suelo_Textura: formData.get('soil-texture') ? formData.get('soil-texture') : null,
        ph_Suelo: formData.get('soil-ph') ? formData.get('soil-ph') : null,
        Precipitacion: formData.get('precipitation') ? formData.get('precipitation') : null,
        Velocidad_Viento: formData.get('wind-speed') ? formData.get('wind-speed') : null,
        Temp_Anual: formData.get('annual-temperature') ? formData.get('annual-temperature') : null,
        Temp_Min: formData.get('minimum-temperature') ? formData.get('minimum-temperature') : null,
        Temp_Max: formData.get('maximum-temperature') ? formData.get('maximum-temperature') : null,
        Radiacion: formData.get('radiation') ? formData.get('radiation') : null,
        Fuente_Agua: formData.get('water-fontain') ? formData.get('water-fontain') : null,
        Caudal_Disponible: formData.get('vailable-flow') ? formData.get('vailable-flow') : null,
        Riego_Metodo: formData.get('irrigation-method') ? formData.get('irrigation-method') : null,
      },
    };
    const jsonDataSinNull = filterNullValues(jsonData);
    const filteredJson = removeEmptyObjects(jsonDataSinNull);

    const validador = ValidatorFactory.crearValidador('createFarm', form);
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

        fetch(url_action, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          mode: "cors",
          cache: "default",
          body: JSON.stringify(filteredJson)
        })
        .then(response => response.json())
        .then(data => {// Respuesta del servidor

          swal.close();
          Swal.fire({
            icon: "success",
            text: "Tu finca ha sido guardada.",
            confirmButtonText: "Aceptar"
          }).then((result) => {
            if (result.isConfirmed || result.isDismissed) {
              window.location.replace('/home');
            }
          });

          // @ts-ignore
          actionButtons.forEach(button => button.disabled = false);
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
          actionButtons.forEach(button => button.disabled = false);
          console.error("Error al enviar el formulario:", error);

        });
        
      }

    }

  }  
});

// Recorre cada input y asigna el evento "input"
let oldValue=null;
if (inputsNumbers) inputsNumbers.forEach(input => {
  input.addEventListener('input', (e) => {
    if (e.target instanceof HTMLInputElement) {
      const valor = e.target.value;
      const pattern = getPattern(input);
  
      if (typeof pattern !== 'object' || !(pattern instanceof RegExp)) {
        console.error('El patrón no es un objeto RegExp válido');
        return;
      }

      // Si el valor no coincide con el patrón, limpia el input
      if (!pattern.test(valor)) {
        e.target.value = oldValue;
        if(e.target.value.length == 1){
          e.target.value = '';
        }
      } else {
        oldValue = e.target.value;
      }
    }
  });

  input.addEventListener('focusin', (e) => {
    oldValue=null;
  });

});
//---- FUNCIONES
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
function removeEmptyObjects(jsonData) {
  const filteredObj = {};
  for (const [key, value] of Object.entries(jsonData)) {
    if (Object.keys(value).length > 0) {
      filteredObj[key] = value;
    }
  }
  return filteredObj;
}
