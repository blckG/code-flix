import { Component } from '@angular/core';
import { NavController, NavParams, ToastController} from 'ionic-angular';
import {UserResource} from "../../providers/resources/user.resource";

/**
 * Generated class for the AddCpfPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

 @Component({
 	selector: 'page-add-cpf',
 	templateUrl: 'add-cpf.html',
 })
 export class AddCpfPage {

 	cpf: string = null;

 	constructor(public navCtrl: NavController, 
 		public navParams: NavParams, 
 		public userResource: UserResource,
 		public toastCtrl: ToastController) {}

 	ionViewDidLoad() {}

 	submit(){
 		this.userResource.addCpf(this.cpf)
 		.then(() => {
 			this.navCtrl.push('PlansPage');
 		})
 		.catch(() => {
 			let toast = this.toastCtrl.create({
 				message: 'Cpf inválido, verifique novamente!',
 				duration: 3000,
 				position: 'bottom'
 			});

 			toast.present();
 		});	
 	}

 }
