import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import scriptjs from 'scriptjs';
import { UserResource } from '../../providers/resources/user.resource';
import { PaymentResource } from '../../providers/resources/payment.resource';
import { Subject } from 'rxjs/Subject';
import { LoadingController } from 'ionic-angular/components/loading/loading-controller';

declare var PAYPAL;

/**
 * Generated class for the PaymentPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@Component({
  selector: 'page-payment',
  templateUrl: 'payment.html',
})
export class PaymentPage {

  user = null;
  payment = null;
  planId = null;
  ppplusLoaded = false;
  ppp = null;
  subject = new Subject;
  loading = null;

  constructor(
    public navCtrl: NavController,
    public navParams: NavParams,
    public loadingCtrl: LoadingController,
    public userResource: UserResource,
    public paymentResource: PaymentResource
  ) {
    this.planId = +this.navParams.get('plan');
  }

  ionViewDidLoad() {
    this.loading = this.loadingCtrl.create({
      content: 'Carregando'
    });
    this.loading.present();

    this.subject.subscribe(() => {
      this.makePayPalPlus();
    }, () => {
      this.loading.dismiss();
    });

    scriptjs('https://www.paypalobjects.com/webstatic/ppplusdcc/ppplusdcc.min.js', () => {
      if(typeof PAYPAL !== undefined){
        this.ppplusLoaded = true;
        this.subject.next();
      } else {
        this.subject.error('PayPal Plus not loaded');
      }
    });

    this.userResource
      .get()
      .subscribe(user => {
        this.user = user
        this.subject.next();
      }, () => this.subject.error('User not loaded'));

    this.paymentResource
      .get(this.planId)
      .subscribe(payment => {
        this.payment = payment;
        this.subject.next();
      }, () => this.subject.error('Payment not loaded'));
  }

  makePayPalPlus() {
    if (this.ppplusLoaded && this.payment !== null && this.user !== null) {
      this.loading.dismiss();
      this.ppp = PAYPAL.apps.PPP({
        approvalUrl: this.payment.approval_url,
        placeholder: 'ppplus',
        mode: 'sandbox',
        country: 'BR',
        language: 'pt_BR',
        payerFirstName: this.user.name.split(" ")[0],
        payerLastName: this.user.name.split(" ")[0],
        payerEmail: this.user.email,
        payerTaxId: this.user.cpf,
        payerTaxIdType: 'BR_CPF'
      });
    }
  }

}
