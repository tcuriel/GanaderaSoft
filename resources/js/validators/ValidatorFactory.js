import { AddInventario } from "./AddInventario";
import { AddPersonal } from "./AddPersonal";
import { AddRebano } from "./AddRebano";
import { CreateFarm } from "./CreateFarm";
import { CreateAnimal } from "./CreateAnimal";
import {UpAnimalesFile} from "./UpAnimalesFile";

export class ValidatorFactory {
    static crearValidador(nombreValidador, formulario) {
      const claseValidador = this.getClaseValidador(nombreValidador);
      if (!claseValidador) {
        throw new Error(`Validador "${nombreValidador}" no encontrado`);
      }
      return new claseValidador(formulario);
    }
  
    static getClaseValidador(nombreValidador) {
      const validadores = {// nombre a clase validador concreto
        'createFarm': CreateFarm,
        'addRebanoFarm': AddRebano,
        'addPersonalFarm': AddPersonal,
        'addInventarioFarm': AddInventario,
        'CreateAnimal': CreateAnimal,
        'UpAnimalesFile': UpAnimalesFile
        // ... validadores
      };
      return validadores[nombreValidador];
    }
  }
