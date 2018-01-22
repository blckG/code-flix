import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import {PlanResource} from "../../providers/resources/plan.resource";

/**
 * Generated class for the PlansPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

 @Component({
 	selector: 'page-plans',
 	templateUrl: 'plans.html',
 })
 export class PlansPage {

 	plans = [];

 	constructor(
 		public navCtrl: NavController, 
 		public navParams: NavParams, 
 		public planResource: PlanResource) {
 	}

 	ionViewDidLoad() {
 		this.planResource.all()
 		.then(plans => this.plans = plans);
 	}

 }
