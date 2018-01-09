import {Component} from '@angular/core';
import {IonicPage, NavController, NavParams} from 'ionic-angular';
import {HttpClient} from "@angular/common/http";
import "rxjs/add/operator/toPromise";


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

    email: string;
    password: string;

    constructor(public navCtrl: NavController, public navParams: NavParams, private http: HttpClient) {
    }

    ionViewDidLoad() {
        console.log('ionViewDidLoad LoginPage');
    }

    login() {
        this.http.post('http://localhost:8000/api/access_token', {
            email: this.email,
            password: this.password
        })
            .toPromise()
            .then((response) =>{
                console.log(response);
            });
    }

}
