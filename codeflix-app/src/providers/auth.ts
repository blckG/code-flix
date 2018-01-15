import { Injectable } from '@angular/core';
import {JwtClient} from "./jwt-client";
import {JwtPayload} from "../models/jwt-payload";
import {Facebook, FacebookLoginResponse} from "@ionic-native/facebook";
import {UserResource} from "./resources/user-resource";

/*
  Generated class for the Auth provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
*/
@Injectable()
export class Auth {

  private _user = null;

  constructor(public jwtClient: JwtClient, public fb: Facebook, public userResource: UserResource) {}

  user(): Promise<Object>{
      return new Promise((resolve) => {
          if(this._user) {
              resolve(this._user);
          }
          this.jwtClient.getPayload().then((payload: JwtPayload) => {
              if (payload) {
                  this._user = payload.user;
              }
             resolve(this._user);
          });
      });
  }

  login({email, password}): Promise<Object> {
      return this.jwtClient.accessToken({email, password})
          .then(() => {
             return this.user();
          });
  }

  loginFacebook(): Promise<string> {
      return this.fb.login(['email'])
          .then((response: FacebookLoginResponse) => {
              let accessToken = response.authResponse.accessToken;
             return this.userResource.register(accessToken)
                 .then(token => this.jwtClient.setToken(token));
          });
  }

  check(): Promise<boolean>{
      return this.user().then(user => {
          return user !== null;
      });
  }

  logout(){
    return this.jwtClient.revokeToken().then(() => {this._user = null});
  }

}
