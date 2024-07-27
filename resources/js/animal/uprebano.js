import { ValidatorFactory } from "../validators/ValidatorFactory";
import Swal from 'sweetalert2';

const submitButton = document.querySelector(".submit");
// @ts-ignore
const fincaId = JSON.parse(window.dataFinca)[0].id_Finca;
// @ts-ignore
const propietarioId = JSON.parse(window.dataFinca)[0].id_Propietario;
// @ts-ignore
const rebanoId = JSON.parse(window.datarebano).id_Rebano;
const fileInput = document.getElementById("herdFile");

// Listener para el botón "Subir Animales"
if(submitButton) submitButton.addEventListener("click", (event) => {

    event.preventDefault(); // Evitar el envío de formulario
    const form = document.getElementById("herd_file_form"); // Obtiene el elemento formulario id
    if(form != null && fileInput != null) {
        // @ts-ignore
        const formData = new FormData();

        const validador = ValidatorFactory.crearValidador('UpAnimalesFile', form);
        validador.validar();
        if (!validador.formularioValido()) {
          validador.obtenerErrores();
          
          Swal.fire({
            icon: "info",
            text: "No se pudo enviar el formulario. Revisa los campos marcados.",
            confirmButtonText: "Aceptar"
          });
    
        } else {
            formData.append('id_Propietario', propietarioId);
            formData.append('id_Finca', fincaId);
            formData.append('id_Rebano', rebanoId);
            // @ts-ignore
            formData.append('archivo', fileInput.files[0]);

            const url_action = form.getAttribute('action');
            const options = {
                method: 'POST',
                headers: {
                  'Content-Type': 'multipart/form-data'
                },
                body: formData
            };

            if(url_action != null) {
                fetch(url_action, options)
                .then(response => response.json())
                .then(data => {
                    console.log('Exito:', data);
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
            console.log(formData);
        }
    }
});