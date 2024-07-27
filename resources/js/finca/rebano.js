import { ValidatorFactory } from "../validators/ValidatorFactory";
import Swal from 'sweetalert2';

const form = document.getElementById("form_add_renbano_farm"); // Obtiene el elemento formulario id
// @ts-ignore
const fincaId = JSON.parse(window.dataFinca)[0].id_Finca;
// @ts-ignore
const url_action = form.getAttribute('action');
const submitButton = document.querySelector(".submit");

// Listener para el botón "Enviar" (opcional)
if(submitButton) submitButton.addEventListener("click", (event) => {
    event.preventDefault(); // Evitar el envío de formulario
    if(form != null) {
        // @ts-ignore
        const formData = new FormData(form);
        const jsonData = {
            rebano: {
                Nombre: formData.get('name') ? formData.get('name') : null
            }
        }

        const validador = ValidatorFactory.crearValidador('addRebanoFarm', form);
        validador.validar();
        if (!validador.formularioValido()) {
            validador.obtenerErrores();
            
            Swal.fire({
              icon: "info",
              text: "No se pudo enviar el formulario. Revisa los campos marcados.",
              confirmButtonText: "Aceptar"
            });
        } else {
            if(url_action != null && fincaId > 0) {

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

                console.log(url_action + fincaId);

                fetch(url_action + fincaId, {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                    },
                    mode: "cors",
                    cache: "default",
                    body: JSON.stringify(jsonData)
                })
                .then(response => response.json())
                .then(data => {// Respuesta del servidor
                    if(data.status == "Error") {
                        swal.close();
                        Swal.fire({
                            icon: "error",
                            text: "Error al enviar el formulario.",
                            confirmButtonText: "Aceptar"
                        });
                    } else {
                        swal.close();
                        Swal.fire({
                            icon: "success",
                            text: "Rebaño agregado exitosamente.",
                            confirmButtonText: "Aceptar"
                        }).then((result) => {
                            if (result.isConfirmed || result.isDismissed) {
                            window.location.replace('/dashboard/finca/rebano/' + fincaId);
                            }
                        });
                    }

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