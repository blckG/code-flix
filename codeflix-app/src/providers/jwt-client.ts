import {HttpClient} from '@angular/common/http';
import {Injectable} from '@angular/core';
import {JwtCredentials} from "../models/jwt-credentials";


/*
  Generated class for the JwtClient provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
*/
@Injectable()
export class JwtClient {

    constructor(public http: HttpClient) {
    }

    accessToken(jwtCredientials: JwtCredentials): Promise<string> {
        return this.http.post('http://localhost:8000/api/access_token', jwtCredientials)
            .toPromise()
            .then((response) => {
                let obj = JSON.parse(JSON.stringify(response));
                return obj.token;
            });
    }

}
