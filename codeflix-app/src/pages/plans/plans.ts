import { Component } from '@angular/core';
import { NavController, NavParams, LoadingController } from 'ionic-angular';
import {PlanResource} from "../../providers/resources/plan.resource";
import {Observable} from "rxjs/Observable";
import 'rxjs/add/operator/map';
import {Auth} from "../../decorators/auth.decorator";

/**
 * Generated class for the PlansPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */
 @Auth()
 @Component({
 	selector: 'page-plans',
 	templateUrl: 'plans.html',
 })
 export class PlansPage {

 	plans: Observable<Array<Object>>;

 	constructor(
 		public navCtrl: NavController,
 		public loadingCtrl: LoadingController, 
 		public navParams: NavParams, 
 		public planResource: PlanResource) {
 	}

 	ionViewDidLoad() {
 		let loading = this.loadingCtrl.create({
 			content: 'Carregando...'
 		});
 		loading.present();
 		this.plans = this.planResource.all()
 		.map(plans => {
 			loading.dismiss();
 			return plans;
 		});
 	}

 }
