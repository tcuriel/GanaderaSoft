import { BaseValidator } from "./BaseValidator";

export class AddRebano extends BaseValidator {
    constructor(form) {
      super(form);
    }
  
    validar() {

      //limpiar errores
      this.removeErrors();

      // Validar campo nombre (requerido, no vacío)
      const name = this.form.elements.name.value;
      if (!name.trim()) {
        this.agregarError(['name-error','El campo "Nombre" es obligatorio.']);
      }

    }
  }