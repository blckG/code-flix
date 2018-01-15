import { Injectable } from '@angular/core';
import {Headers, Http, RequestOptions} from '@angular/http';
import 'rxjs/add/operator/toPromise';
import {Env} from "../../models/env";

declare var ENV: Env;

/*
  Generated class for the ResourcesUserResouceProvider provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
*/
@Injectable()
export class UserResource {

  constructor(public http: Http) {}

  register(accessToken: string): Promise<string> {
    let headers = new Headers();
    headers.set('Authorization', `Bearer ${accessToken}`);
    return this.http.post(`${ENV.APP_URL}/register`, {}, new RequestOptions({headers}))
        .toPromise()
        .then(response => response.json().token);
  }

}
