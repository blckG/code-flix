import { Injectable } from '@angular/core';
import {JwtClient} from "./jwt-client";
import {JwtPayload} from "../models/jwt-payload";
import {Facebook, FacebookLoginResponse} from "@ionic-native/facebook";
import {UserResource} from "./resources/user.resource";
import {BehaviorSubject} from "rxjs/BehaviorSubject";
import {UserModel} from "./sqlite/user.model";
import {AuthGuard} from "./auth-guard";
import {AppConfig} from "./app-config";

/*
  Generated class for the Auth provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
  */
  @Injectable()
  export class Auth implements AuthGuard{

    private _user = null;
    private _userSubject = new BehaviorSubject(null);

    constructor(
        public jwtClient: JwtClient,
        public fb: Facebook,
        public userResource: UserResource,
        public userModel: UserModel,
        public appConfig: AppConfig) {}

    user(): Promise<Object>{
      return new Promise((resolve) => {
        if(this._user) {
          resolve(this._user);
        }
        this.jwtClient.getPayload().then((payload: JwtPayload) => {
          if (payload) {
            this._user = payload.user;
            this._userSubject.next(this._user);
          }
          resolve(this._user);
        });
      });
    }

    userSubject(): BehaviorSubject<Object>{
      return this._userSubject;
    }

    login({email, password}): Promise<Object> {
      return this.jwtClient.accessToken({email, password})
      .then(() => {
        this.appConfig.setOff(false);
        return this.user().then(user => {
          this.saveUser(user);
          return user;
        });
      });
    }

    private saveUser(user){
      this.userModel.save(user);
    }

    loginFacebook(): Promise<Object> {
      return this.fb.login(['email'])
      .then((response: FacebookLoginResponse) => {
        let accessToken = response.authResponse.accessToken;
        return this.userResource.register(accessToken)
        .then(token => {
          this.jwtClient.setToken(token);
          return this.user();
        });
      });
    }

    check(): Promise<boolean>{
      return this.user().then(user => {
        return user !== null;
      });
    }

    logout(): Promise<any> {
      return this.jwtClient.revokeToken().then(() => {
        this._user = null;
        this._userSubject = this._user;
      });
    }

  }
