export class BaseValidator {
    constructor(form) {
        this.form = form;
        this.errors = [];
    }
  
    validar() {
        throw new Error();
    }
  
    agregarError(mensaje) {
        this.errors.push(mensaje);
    }
  
    removeErrors() {
        const invalidFeedbacks = document.querySelectorAll(".invalid-feedback");
        invalidFeedbacks.forEach(element => {
          element.textContent = "";
          element.classList.remove("d-block");
        });
    }

    obtenerErrores() {
        this.errors.forEach(element => {
            const invalidFiel = document.getElementById(element[0]);
            if(invalidFiel != null) {
                invalidFiel.classList.add("d-block");
                invalidFiel.textContent = element[1];
            }
        });
    }
  
    formularioValido() {
        return this.errors.length === 0;
    }
}