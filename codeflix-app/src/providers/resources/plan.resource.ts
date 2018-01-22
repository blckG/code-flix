import { Injectable } from '@angular/core';
import 'rxjs/add/operator/map';
import {Observable} from "rxjs/Observable";
import {AuthHttp} from "angular2-jwt";
import {Env} from "../../models/env";

declare var ENV: Env;

/*
  Generated class for the ResourcesPlanResourceProvider provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
  */
  @Injectable()
  export class PlanResource {

  	constructor(public http: AuthHttp) {}

  	all(): Observable<Array<Object>> {
  		return this.http.get(`${ENV.APP_URL}/plans`)
  		.map(response => response.json().plans);
  	}

  }
