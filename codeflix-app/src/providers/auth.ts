import { Injectable } from '@angular/core';
import {JwtClient} from "./jwt-client";
import {JwtPayload} from "../models/jwt-payload";

/*
  Generated class for the Auth provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
*/
@Injectable()
export class Auth {

  private _user = null;

  constructor(public jwtClient: JwtClient) {}

  user(): Promise<Object>{
      return new Promise((resolve) => {
          if(this._user) {
              resolve(this._user);
          }
          this.jwtClient.getPayload().then((payload: JwtPayload) => {
             this._user = payload.user;
             resolve(this._user);
          });
      });
  }

}
