import { BaseValidator } from "./BaseValidator";

export class UpAnimalesFile extends BaseValidator {
    constructor(form) {
      super(form);
    }
    validar() {
        //limpiar errores
        this.removeErrors();

        // Validar campo separator (requerido, no vacío)
        const separator = this.form.elements.separator.value;
        if (!separator) {
            this.agregarError(['separator-error','El campo "Separador CSV" es obligatorio.']);
        }

        // Validar campo explotacion (requerido, no vacío)
        const herdFile = this.form.elements.herdFile.value;
        if (!herdFile) {
            this.agregarError(['herdFile-error','El campo "Archivo CSV" es obligatorio.']);
        }
    }
}