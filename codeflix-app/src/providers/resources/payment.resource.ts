import { Injectable } from '@angular/core';
import 'rxjs/add/operator/map';
import { AuthHttp } from 'angular2-jwt';
import { Observable } from 'rxjs/Observable';
import { Env } from '../../models/env';

declare var ENV: Env;

/*
  Generated class for the PaymentResourceProvider provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
*/
@Injectable()
export class PaymentResource {

  constructor(public http: AuthHttp) { }

  get(planId: number): Observable<Object> {
    return this.http.post(`${ENV.APP_URL}/plans/${planId}/payments`, {})
      .map(response => response.json());
  }

  doPyment(planId: number, paymentId: string, payerId: string): Observable<Object> {
    return this.http.patch(`${ENV.APP_URL}/plans/${planId}/payments`, {
      payment_id: paymentId,
      payer_id: payerId
    })
      .map(response => response.json());
  }

}
