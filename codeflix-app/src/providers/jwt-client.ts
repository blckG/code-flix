import {Injectable} from '@angular/core';
import {JwtCredentials} from "../models/jwt-credentials";
import {Storage} from "@ionic/storage";
import {AuthHttp, JwtHelper} from "angular2-jwt";
import {Env} from "../models/env";
import {Response} from "@angular/http";
declare var ENV: Env;

/*
  Generated class for the JwtClient provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
*/
@Injectable()
export class JwtClient {

    private _token = null;
    private _payload = null;

    constructor(public authHttp: AuthHttp, public storage: Storage, public jwtHelper: JwtHelper) {
        this.getToken();
    }

    accessToken(jwtCredientials: JwtCredentials): Promise<string> {
        return this.authHttp.post(`${ENV.APP_URL}/access_token`, jwtCredientials)
            .toPromise()
            .then((response: Response) => {
                this._token = response.json().token;
                this.storage.set(ENV.TOKEN_NAME, this._token);
                return this._token;
            });
    }

    getToken(): Promise<string>{
        return new Promise((resolve) => {
           if(this._token) {
               resolve(this._token);
           }
           this.storage.get(ENV.TOKEN_NAME).then((token) => {
               this._token = token;
               resolve(this._token);
           });
        });
    }

    getPayload(): Promise<Object>{
        return new Promise((resolve) => {
            if(this._payload) {
                resolve(this._payload);
            }
            this.getToken().then((token) => {
                if(token){
                    this._payload = this.jwtHelper.decodeToken(token);
                }
                resolve(this._payload);
            })
        });
    }

    revokeToken(): Promise<null>{
        return this.authHttp.post(`${ENV.APP_URL}/logout`, {})
            .toPromise()
            .then((response) => {
               this._token = null;
               this._payload = null;
               this.storage.clear();
               return null;
            });
    }

}
