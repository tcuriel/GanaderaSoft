import { BaseValidator } from "./BaseValidator";

export class AddInventario extends BaseValidator {
    constructor(form) {
        super(form);
    }
  
    validar() {

        //limpiar errores
        this.removeErrors();

        // Validar campo nombre (requerido, seleccionado)
        const opcionSeleccionada = document.querySelector('input[name="radioinventario"]:checked');

        if (!opcionSeleccionada) {
            this.agregarError(['inventario-error','El campo "Inventario" es obligatorio.Seleccionar un tipo de inventario']);
        }

    }
  }