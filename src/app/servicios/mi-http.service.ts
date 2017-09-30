import { Injectable } from '@angular/core';
import { Http, Response, Headers, RequestOptions, URLSearchParams } 
from '@angular/http';
import 'rxjs/add/operator/toPromise';

@Injectable()
export class MiHttpService {

  headers: Headers;
  options: RequestOptions;
  constructor(public http:Http) { 
    this.headers = new Headers({ 'Content-Type': 'application/json', 
    'Accept': 'q=0.8;application/json;q=0.9' });
this.options = new RequestOptions({ headers: this.headers });
   
  }


  
  testRequest(url: string)  {
    let data = new URLSearchParams();
    data.append('nombre', "Leandro");
    data.append('mail', "lea@lea.com");
    data.append('sexo', "masculino");
    data.append('password', "Prueba");
  
   return this.http
      .post(url, data)
        .subscribe(data => {
             console.log(data);
        }, error => {
            console.log(error.json());
        });
  }

 
  dameunapromesa(url:string)
  {

    return this.http
    .get(url)
    .toPromise()
    .then(this.extraerDatos)
    .catch(this.manejadorDeError);
  }

  manejadorDeError(error:Response|any)
  { 
    return error;
  }

  extraerDatos(respuesta:Response)
  {
    return respuesta.json()||{};
  }

}
