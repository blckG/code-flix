import {HttpClient, HttpHeaders} from '@angular/common/http';
import {Injectable} from '@angular/core';
import {JwtCredentials} from "../models/jwt-credentials";
import {Storage} from "@ionic/storage";
import {JwtHelper} from "angular2-jwt";


/*
  Generated class for the JwtClient provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
*/
@Injectable()
export class JwtClient {

    private _token = null;
    private _payload = null;

    constructor(public http: HttpClient, public storage: Storage, public jwtHelper: JwtHelper) {
        this.getToken();
    }

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

    getToken(): Promise<string>{
        return new Promise((resolve) => {
           if(this._token) {
               resolve(this._token);
           }
           this.storage.get('token').then((token) => {
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
        return this.http.post('http://localhost:8000/api/logout', {}, {
            headers: new HttpHeaders().set('Authorization', `Bearer ${this._token}`)
        })
            .toPromise()
            .then((response) => {
               this._token = null;
               this._payload = null;
               this.storage.clear();
               return null;
            });
    }

}
