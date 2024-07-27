import { BaseValidator } from "./BaseValidator";

export class AddPersonal extends BaseValidator {
    constructor(form) {
      super(form);
    }
  
    validar() {
      const regexNumberId = /^.(VEJPG|vejpg){0,1}-(\d{0,8})(?:-(?:\d{1}))?$/;
      const regexEmail = /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;

      //limpiar errores
      this.removeErrors();

      // Validar campo Numero de Identificación (requerido, no vacío)
      const idnumber = this.form.elements.idnumber.value;
      if (!regexNumberId.test(idnumber)) {
        this.agregarError(['idnumber-error','El campo "Numero de Identificación" no es valido. Debe cumplir con (VEJPG)-12345678-9']);
      }
      if (!idnumber.trim()) {
        this.agregarError(['idnumber-error','El campo "Numero de Identificación" es obligatorio.']);
      }
      // Validar campo Nombre (requerido, no vacío)
      const name = this.form.elements.name.value;
      // Validar campo Nombre (no mayor a 25)
      if (name.length > 25) {
        this.agregarError(['name-error','El campo "Nombre" es demasiado largo debe ser maximo 25 caracteres.']);
      }
      if (!name.trim()) {
        this.agregarError(['name-error','El campo "Nombre" es obligatorio.']);
      }
      // Validar campo Apellido (requerido, no vacío)
      const lastname = this.form.elements.lastname.value;
      // Validar campo Apellido (no mayor a 25)
      if (lastname.length > 25) {
        this.agregarError(['lastname-error','El campo "Nombre" es demasiado largo debe ser maximo 25 caracteres.']);
      }
      if (!lastname.trim()) {
        this.agregarError(['lastname-error','El campo "Apellido" es obligatorio.']);
      }
      // Validar campo Teléfono (requerido, no vacío)
      const phone = this.form.elements.phone.value;
      // Validar campo Teléfono (no mayor a 15, no menor que 10)
      if (phone.length > 25 || phone.length < 10) {
        this.agregarError(['phone-error','El campo "Teléfono" es debe poseer de 10 a 15 dígitos.']);
      }
      if (!phone.trim()) {
        this.agregarError(['phone-error','El campo "Teléfono" es obligatorio.']);
      }
      // Validar campo Correo (requerido, no vacío)
      const email = this.form.elements.email.value;
      if (!regexEmail.test(email)) {
        this.agregarError(['email-error','El campo "Correo" no es valido. Debe ser un correo elecrtronico valido.']);
      }
      if (!email.trim()) {
        this.agregarError(['email-error','El campo "Correo" es obligatorio.']);
      }
      // Validar campo Tipo de Trabajador (requerido, no vacío)
      const worker = this.form.elements.worker.value;
      if (!worker.trim()) {
        this.agregarError(['worker-error','El campo "Tipo de Trabajador" es obligatorio.']);
      }
      // Validar campo Tipo de Trabajador (no mayor a 20)
      if (worker.length > 20) {
        this.agregarError(['worker-error','El campo "Nombre" es demasiado largo debe ser maximo 20 caracteres.']);
      }
    }
  }