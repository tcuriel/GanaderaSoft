import { ValidatorFactory } from "../validators/ValidatorFactory";
import Swal from 'sweetalert2';

const form = document.getElementById("form_add_personal_farm"); // Obtiene el elemento formulario id
const inputsPatterns = document.querySelectorAll('[data-pattern-input]');
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

if(form != null) {
    form.addEventListener("submit", (event) => {
        const url_action = form.getAttribute('action');
        if(url_action != null) {

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
                createData(url_action, dataFinca);
            }
        }
    });
}

/**
 * @param {string} url_action
 * @param {{personal_finca: { Cedula: FormDataEntryValue | null; Nombre: FormDataEntryValue | null; Apellido: FormDataEntryValue | null; Telefono: FormDataEntryValue | null; Correo: FormDataEntryValue | null; Tipo_Trabajador: FormDataEntryValue | null; }; }} dataFinca
 */
async function createData(url_action, dataFinca) {

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
        method: "POST",
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
            text: "Personal archivado exitosamente, presiona ‘Confirmar’ para acceder a tu Personal.",
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
