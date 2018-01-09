import {HttpClient} from '@angular/common/http';
import {Injectable} from '@angular/core';
import {JwtCredentials} from "../models/jwt-credentials";
import {Storage} from "@ionic/storage";


/*
  Generated class for the JwtClient provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
*/
@Injectable()
export class JwtClient {

    private _token = null;
    constructor(public http: HttpClient, public storage: Storage) {}

    accessToken(jwtCredientials: JwtCredentials): Promise<string> {
        return this.http.post('http://localhost:8000/api/access_token', jwtCredientials)
            .toPromise()
            .then((response) => {
                let obj = JSON.parse(JSON.stringify(response));
                this._token = obj.token;
                this.storage.set('token', this._token);
                return obj.token;
            });
    }

}
