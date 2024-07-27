import { BaseValidator } from "./BaseValidator";

export class CreateAnimal extends BaseValidator {
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

        // Validar campo sexo (requerido, no vacío)
        const sex = this.form.elements.sex.value;
        if (!sex) {
            this.agregarError(['sex-error','El campo "Sexo" es obligatorio.']);
        }

        // Validar campo Edad (requerido, no vacío)
        const age = this.form.elements.age.value;
        if (!age) {
            this.agregarError(['age-error','El campo "Edad" es obligatorio.']);
        }

        // Validar campo Tipo (requerido, no vacío)
        const type = this.form.elements.type.value;
        if (!type) {
            this.agregarError(['type-error','El campo "Tipo" es obligatorio.']);
        }

        // Validar campo Estado (requerido, no vacío)
        const state = this.form.elements.state.value;
        if (!state) {
            this.agregarError(['state-error','El campo "Estado" es obligatorio.']);
        }

        // Validar campo Rebaño (requerido, no vacío)
        const herd = this.form.elements.herd.value;
        if (!herd) {
            this.agregarError(['herd-error','El campo "Rebaño" es obligatorio.']);
        }

        // Validar campo Procedencia (requerido, no vacío)
        const origin = this.form.elements.origin.value;
        if (!origin.trim()) {
            this.agregarError(['origin-error','El campo "Procedencia" es obligatorio.']);
        }
        if (origin.length > 50) {
            this.agregarError(['origin-error','El campo "Procedencia" es demasiado largo debe ser maximo 50 caracteres.']);
        }
    }
}
