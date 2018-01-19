import {Component} from '@angular/core';
import {NavController, ToastController} from 'ionic-angular';
import {UserResource} from "../../providers/resources/user.resource";
import {Auth} from "../../decorators/auth.decorator";

/**
 * Generated class for the UserSettingsPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */
 @Auth()
 @Component({
     selector: 'page-user-settings',
     templateUrl: 'user-settings.html',
 })
 export class UserSettingsPage {

     password: string;

     constructor(public navCtrl: NavController, public userResource: UserResource, public toastCtrl: ToastController) {}


     changePassword() {
         this.userResource.changePassword(this.password)
         .then(() => {
             this.showMessage("Senha alterada com sucesso!");
             this.password = null;
         })
         .catch(() => {
             this.showMessage("Campo obrigatório.");
         });
     }

     showMessage(message: string) {
         let toast = this.toastCtrl.create({
             message: message,
             duration: 3000,
             position: 'bottom'
         });

         toast.present();
     }

 }
