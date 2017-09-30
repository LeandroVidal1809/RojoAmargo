import { Component, OnInit } from '@angular/core';
import { Router, ActivatedRoute, ParamMap } from '@angular/router';
import {Validators,FormBuilder,FormControl,FormGroup  } from '@angular/forms';
@Component({
  selector: 'app-registro',
  templateUrl: './registro.component.html',
  styleUrls: ['./registro.component.css']
})
export class RegistroComponent implements OnInit {

  constructor(private build:FormBuilder) { }

  ngOnInit() {
  }
  LoginValidation:FormGroup= this.build.group({});
  email:FormControl = new FormControl("",[Validators.required]);
}
