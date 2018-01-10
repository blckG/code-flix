import {Component} from '@angular/core';
import {IonicPage, NavController, NavParams} from 'ionic-angular';
import "rxjs/add/operator/toPromise";
import {Auth} from "../../providers/auth";


/**
 * Generated class for the LoginPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */
@IonicPage()
@Component({
    selector: 'page-login',
    templateUrl: 'login.html',
})
export class LoginPage {

    user = {
        email: null,
        password: null
    };

    constructor(public navCtrl: NavController, public navParams: NavParams, private auth: Auth) {
    }

    ionViewDidLoad() {
        console.log('ionViewDidLoad LoginPage');
    }

    login() {
        this.auth.login(this.user)
            .then(() => {
                //redirect
            });
        /*this.jwtClient
            .accessToken({email: this.email, password: this.password})
            .then((token) => {
                console.log(token);
            });*/
    }

}
