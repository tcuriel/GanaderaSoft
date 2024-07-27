import { BaseValidator } from "./BaseValidator";

export class CreateFarm extends BaseValidator {
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

      if (name.length > 25) {
        this.agregarError(['name-error','El campo "Nombre" es demasiado largo debe ser maximo 25 caracteres.']);
      }

      // Validar campo explotacion (requerido, no vacío)
      const exploitation = this.form.elements.exploitation.value;
      if (!exploitation) {
        this.agregarError(['exploitation-error','El campo "Explotación" es obligatorio.']);
      }

      // Validar campo id hierro (no vacío  , 10 caracteres)
      const idiron = this.form.elements.idiron.value;
      if((idiron.length > 0) && (idiron.length != 10)) {
        this.agregarError(['idiron-error','El ID de hierro no es válido. Debe tener 10 caracteres.']);
      }
    }
}
