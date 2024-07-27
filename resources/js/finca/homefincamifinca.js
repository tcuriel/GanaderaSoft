import { ValidatorFactory } from "../validators/ValidatorFactory";
import Swal from 'sweetalert2';

const form = document.getElementById("form_update_farm"); // Obtiene el elemento formulario id
const inputsNumbers = document.querySelectorAll('[data-numbers-only]');
const buttonFincaSave = document.getElementById("fincaSave");
const buttonFincaDelete = document.getElementById("fincaDelete");

// @ts-ignore
const fincaId = JSON.parse(window.dataFinca)[0].id_Finca;
// @ts-ignore
const fincaname = JSON.parse(window.dataFinca)[0].Nombre;
// @ts-ignore
const url_action = window.actionGet;
let swal;
let idPropietario;
let updatedFinca = false;
let updatedHierro = false;
let updatedTerreno = false;

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

if(fincaId != null && fincaId > 0) {

  swal = Swal.fire({
    title: "Obteniendo datos de " + fincaname + " ...",
    timerProgressBar: true,
    didOpen: () => {
      Swal.showLoading();
    }
  });

  fetch(url_action + fincaId, {
    method: "GET",
    headers: {
      "Content-Type": "application/json",
    }
  })
  .then(response => response.json())
  .then(data => {// Respuesta del servidor

    swal.close();
    if(form != null) {  
      //Finca
      if(data.data[0] != null) {
        const nameInput = form.querySelector("#name");
        // @ts-ignore
        if (nameInput != null) nameInput.value = data.data[0].Nombre ?? "";
        const exploitationSelect = form.querySelector("#exploitation");
        // @ts-ignore
        if (exploitationSelect != null) exploitationSelect.value = data.data[0].Explotacion_Tipo ?? "";
        idPropietario = data.data[0].id_Propietario;
      }
      //Hierro
      if(data.data[1] != null) {
        const idironInput = form.querySelector("#idiron");
        // @ts-ignore
        if (idironInput != null && data.data[1].identificador != null) idironInput.value = data.data[1].identificador ?? "";
      }
      //Terreno
      if(data.data[2] != null) {
        const annualtemperatureInput = form.querySelector("#annual-temperature");
        // @ts-ignore
        if (annualtemperatureInput != null) annualtemperatureInput.value = data.data[2].Temp_Anual ?? "";
        const vailableflowInput = form.querySelector("#vailable-flow");
        // @ts-ignore
        if (vailableflowInput != null) vailableflowInput.value = data.data[2].Caudal_Disponible ?? "";
        const irrigationmethodInput = form.querySelector("#irrigation-method");
        // @ts-ignore
        if (irrigationmethodInput != null) irrigationmethodInput.value = data.data[2].Riego_Metodo ?? "";
        const soilphInput = form.querySelector("#soil-ph");
        // @ts-ignore
        if (soilphInput != null) soilphInput.value = data.data[2].ph_Suelo ?? "";
        const reliefInput = form.querySelector("#relief");
        // @ts-ignore
        if (reliefInput != null) reliefInput.value = data.data[2].Relieve ?? "";
        //Terreno step2
        const precipitationInput = form.querySelector("#precipitation");
        // @ts-ignore
        if (precipitationInput != null) precipitationInput.value = data.data[2].Precipitacion ?? "";
        const maximumtemperatureInput = form.querySelector("#maximum-temperature");
        // @ts-ignore
        if (maximumtemperatureInput != null) maximumtemperatureInput.value = data.data[2].Temp_Max ?? "";
        const minimumtemperatureInput = form.querySelector("#minimum-temperature");
        // @ts-ignore
        if (minimumtemperatureInput != null) minimumtemperatureInput.value = data.data[2].Temp_Min ?? "";
        const radiationInput = form.querySelector("#radiation");
        // @ts-ignore
        if (radiationInput != null) radiationInput.value = data.data[2].Radiacion ?? "";
        const soiltextureInput = form.querySelector("#soil-texture");
        // @ts-ignore
        if (soiltextureInput != null) soiltextureInput.value = data.data[2].Suelo_Textura ?? "";
        const windspeedInput = form.querySelector("#wind-speed");
        // @ts-ignore
        if (windspeedInput != null) windspeedInput  .value = data.data[2].Velocidad_Viento ?? "";
        const surfaceInput = form.querySelector("#surface");
        // @ts-ignore
        if (surfaceInput != null) surfaceInput  .value = data.data[2].Superficie ?? "";
        const waterfontainInput = form.querySelector("#water-fontain");
        // @ts-ignore
        if (waterfontainInput != null) waterfontainInput  .value = data.data[2].Fuente_Agua ?? "";
      }
    }

  })
  .catch(error => {// Error

    swal.close();
    swal = Swal.fire({
      icon: "error",
      text: "Error al obtener el formulario.",
      confirmButtonText: "Aceptar"
    });

    console.error("Error al obtener el formulario:", error);

  });

}

/**
 * FINCA SECCION FORMOLARIO
 */
const steps = document.querySelectorAll(".stepfarm");
const nextButton = document.querySelector(".nextfarm");
const backButton = document.querySelector(".backfarm");
const submitButton = document.getElementById("submitfarm");
//const inputsNumbers = document.querySelectorAll('[data-numbers-only]');

let currentStep = 1;

/**
 * @param {number} stepNumber
 */
function showStep(stepNumber) {
  steps.forEach((step, index) => {
    // @ts-ignore
    if(step) step.style.display = index === stepNumber - 1 ? "flex" : "none";
  });
}

/**
 * @param {number} step
 */
function hideButtons(step) {
  const limit = steps.length;
  const actionButtons = document.querySelectorAll(".action");
  // @ts-ignore
  actionButtons.forEach(button => button.style.display = "none");

  if (step < limit && nextButton) {// Muestra el botón "Siguiente"
    // @ts-ignore
    nextButton.style.display = "inline";
  }

  if (step > 1 && backButton) {// Muestra el botón "Regresar"
    // @ts-ignore
    backButton.style.display = "inline";
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

if(submitButton) submitButton.addEventListener("click", (event) => {
  event.preventDefault(); // Evitar el envío de formulario
  swal =  Swal.fire({
    title: "Modificar Mi Finca",
    text: "¿Seguro que desea Modificar esta  Finca?",
    icon: "question",
    showCancelButton: true,
    confirmButtonText: "Confirmar",
    cancelButtonText: "Atrás",
    confirmButtonColor: "#148FBE",
    cancelButtonColor: "#C0D43B",
  }).then((result) => {
    if (result.isConfirmed) {

      const validador = ValidatorFactory.crearValidador('createFarm', form);
      validador.validar();
      if (!validador.formularioValido()) {
        validador.obtenerErrores();

        swal = Swal.fire({
          icon: "info",
          text: "No se pudo enviar el formulario. Revisa los campos marcados.",
          confirmButtonText: "Aceptar"
        });
    
      } else {  
        if(form != null) {
          const rutas = [form.getAttribute('action')];
          if(rutas[0] != null) {
            const rutasParseadas = rutas[0].split(",");
            // @ts-ignore
            const formData = new FormData(form);
    
            const url_fincaUpdate = rutasParseadas[0] + fincaId;
            const dataFinca = {
              tipo: "finca",
              finca: {
                Nombre: formData.get('name') ? formData.get('name') : null,
                Explotacion_Tipo: formData.get('exploitation') ? formData.get('exploitation') : null,
              }
            };
            updateData(url_fincaUpdate, dataFinca);
    
            const url_hierroUpdate = rutasParseadas[1] + fincaId + "/" + idPropietario;
            const dataHierro = {
              tipo: "hierro",
              hierro: {
                identificador: formData.get('idiron') ? formData.get('idiron') : null,
              }
            };
            updateData(url_hierroUpdate, dataHierro);
    
            const url_terrenoUpdate =  rutasParseadas[2] + fincaId;
            const dataTerreno = {
              tipo: "terreno",
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
              }
            };
            updateData(url_terrenoUpdate, dataTerreno);
            
            Swal.fire({ //HTML
              icon: "success",
              text: "Finca modificada exitosamente, presiona ‘Confirmar’ para acceder a las diversas Gestiones de tu Finca",
              confirmButtonText: "Confirmar"
            }).then((result) => {
              if (result.isConfirmed || result.isDismissed) {
                window.location.replace('/dashboard/finca/finca/' + fincaId);
              }
            });
    
          } 
        }
      }
    }
  });

});

if(buttonFincaSave) buttonFincaSave.addEventListener("click", (event) => {
  swal =  Swal.fire({
    title: "Archivar Mi Finca",
    text: "¿Seguro que desea Archivar esta  Finca?",
    icon: "question",
    //showCancelButton: true,
    confirmButtonText: "Atrás",
    //cancelButtonText: "Atrás",
    confirmButtonColor: "#148FBE",
    cancelButtonColor: "#C0D43B",
  }).then((result) => {
    console.log(result);
  });
});

if(buttonFincaDelete) buttonFincaDelete.addEventListener("click", (event) => {
  swal =  Swal.fire({
    title: "Eliminar Mi Finca",
    text: "¿Seguro que desea Eliminar esta  Finca?",
    icon: "question",
    //showCancelButton: true,
    confirmButtonText: "Atrás",
    //cancelButtonText: "Atrás",
    confirmButtonColor: "#148FBE",
    cancelButtonColor: "#C0D43B",
  }).then((result) => {
    console.log(result);
  });
});

/**
 * @param {RequestInfo | URL} url
 * @param {{ tipo: any; finca?: { Nombre: FormDataEntryValue | null; Explotacion_Tipo: FormDataEntryValue | null; }; hierro?: { identificador: FormDataEntryValue | null; }; terreno?: { Superficie: FormDataEntryValue | null; Relieve: FormDataEntryValue | null; Suelo_Textura: FormDataEntryValue | null; ph_Suelo: FormDataEntryValue | null; Precipitacion: FormDataEntryValue | null; Velocidad_Viento: FormDataEntryValue | null; Temp_Anual: FormDataEntryValue | null; Temp_Min: FormDataEntryValue | null; Temp_Max: FormDataEntryValue | null; Radiacion: FormDataEntryValue | null; Fuente_Agua: FormDataEntryValue | null; Caudal_Disponible: FormDataEntryValue | null; Riego_Metodo: FormDataEntryValue | null; }; }} datos
 */
async function updateData(url, datos) {
  try {

    const respuesta = await fetch(url, {
      method: "PUT",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(datos),
    });
    // @ts-ignore
    if (!respuesta.ok) {
      console.error(`Error al actualizar datos: ${respuesta.statusText}`);
      //throw new Error(`Error al actualizar datos: ${respuesta.statusText}`);
    }

    //const datosActualizados = await respuesta.json();
    if(datos.tipo == 'finca'){
      updatedFinca = true;
    }
    if(datos.tipo == 'hierro'){
      updatedHierro = true;
    }
    if(datos.tipo == 'terreno'){
      updatedTerreno = true;
    }

  } catch (error) {
    console.error("Error al actualizar los datos:", error.message);
  }
}

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
