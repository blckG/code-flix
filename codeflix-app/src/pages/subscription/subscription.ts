import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import { UserResource } from '../../providers/resources/user.resource';
import { Auth } from '../../decorators/auth.decorator';
import { LoadingController } from 'ionic-angular/components/loading/loading-controller';

/**
 * Generated class for the SubscriptionPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */
@Auth()
@Component({
  selector: 'page-subscription',
  templateUrl: 'subscription.html',
})
export class SubscriptionPage {

  subscriptions;

  constructor(
    public navCtrl: NavController, 
    public navParams: NavParams,
    public loadingCtrl: LoadingController, 
    public userResource: UserResource
  ) {}

  ionViewDidLoad() {
    let loading = this.loadingCtrl.create({
      content: 'Carregando...'
    });
    loading.present();

    this.userResource
        .getSubscriptions()
        .then(subscriptions => {
          loading.dismiss();
          this.subscriptions = subscriptions;
        });
  }

}
