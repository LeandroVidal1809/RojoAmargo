import { Injectable } from '@angular/core';
import { Juego } from '../clases/Juego';
import { JuegoAdivina } from '../clases/juego-adivina';
import {MiHttpService} from './mi-http.service';
@Injectable()
export class JuegoServiceService {

  constructor(public mihttp:MiHttpService) { }

  public listar(): Array<Juego> {
    this.mihttp.testRequest("http://localhost:8080/LABORATORIO/Parcial/ApiRestParcial/apirest_PrimerParcial/index.php/user/")
    // @lea.then(datos => {
    //   console.log(datos);
    // });
    
    
    // this.mihttp.dameunapromesa("http://localhost:8080/LABORATORIO/Parcial/ApiRestParcial/apirest_PrimerParcial/index.php/user/")
    // .then(datos =>{console.log(datos)});
  
    let miArray: Array<Juego> = new Array<Juego>();

    miArray.push(new JuegoAdivina("Juego 1", false));
    miArray.push(new JuegoAdivina("Pepe", true));
    miArray.push(new JuegoAdivina("Juego 3", false));
    miArray.push(new JuegoAdivina("Juego 4", false));
    miArray.push(new JuegoAdivina("Juego 5", false));
    miArray.push(new JuegoAdivina("Juego 6", false));
    return miArray;
  }

  public listarPromesa(): Promise<Array<Juego>> {
    let promesa: Promise<Array<Juego>> = new Promise((resolve, reject) => {
      let miArray: Array<Juego> = new Array<Juego>();
      miArray.push(new JuegoAdivina("JuegoPromesa 1", false,"promesa"));
      miArray.push(new JuegoAdivina("PepePromesa", true));
      miArray.push(new JuegoAdivina("JuegoPromesa 3", false));
      miArray.push(new JuegoAdivina("JuegoPromesa 4", false));
      miArray.push(new JuegoAdivina("JuegoPromesa 5", false));
      miArray.push(new JuegoAdivina("JuegoPromesa 6", false));
      resolve(miArray);
    });

    return promesa;
  }

}
