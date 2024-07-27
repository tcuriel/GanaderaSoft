import { ValidatorFactory } from "../validators/ValidatorFactory";
import Swal from 'sweetalert2';

const form = document.getElementById("form_add_inventario_farm"); // Obtiene el elemento formulario id
// @ts-ignore
const fincaId = JSON.parse(window.dataFinca)[0].id_Finca;
const validador = ValidatorFactory.crearValidador('addInventarioFarm', form);

/*const radioGroup = document.querySelector('.btn-group');
if(radioGroup != null) radioGroup.addEventListener('change', validador.validar());*/

if(form != null) {
    form.addEventListener("submit", (event) => {
        const url_action = form.getAttribute('action');
        if(url_action != null) {

            event.preventDefault();
            
            validador.validar();
            if (!validador.formularioValido()) {
                validador.obtenerErrores();

                Swal.fire({
                    icon: "info",
                    text: "No se pudo enviar el formulario. Revisa los campos marcados.",
                    confirmButtonText: "Aceptar"
                });

            } else {

                const opcionSeleccionada = document.querySelector('input[name="radioinventario"]:checked');
                // @ts-ignore
                const url_actionPost = url_action + opcionSeleccionada.value +"/" + fincaId
                createData(url_actionPost);

            }

        }
    });
}

async function createData(url_action) {
    const actionButton = document.getElementById("fincaInventarioSave");
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
        }
    })
    .then(response =>{
        if (response.status === 500) {
            swal.close();
            Swal.fire({
                icon: "error",
                text: "Error al enviar el formulario.",
                confirmButtonText: "Aceptar"
            });
    
            // @ts-ignore
            actionButton.disabled = false;
        }
        return response.json();
      })
    .then(data => {// Respuesta del servidor

        console.log(data);
        swal.close();
        Swal.fire({
            icon: "success",
            text: "Inventario contabilizado Exitosamente, presione Confirmar.",
            confirmButtonText: "Confirmar"
        }).then((result) => {
            if (result.isConfirmed || result.isDismissed) {
                window.location.replace('/dashboard/finca/inventario/'+ fincaId);
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
