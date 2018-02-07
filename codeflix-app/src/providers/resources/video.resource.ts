import {Injectable} from '@angular/core';
import 'rxjs/add/operator/map';
import {AuthHttp} from "angular2-jwt";
import {Observable} from "rxjs/Observable";
import {Env} from "../../models/env";

declare var ENV: Env;

/*
  Generated class for the VideoResourceProvider provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
*/
@Injectable()
export class VideoResource {

    constructor(public http: AuthHttp) {}

    latest(page: number): Observable<any> {
        return this.http
            .get(`${ENV.APP_URL}/videos`)
            .map(response => response.json().data);
    }

    get(id: number): Observable<any>{
        return this.http
            .get(`${ENV.APP_URL}/videos/${id}`)
            .map(response => response.json());
    }

}
