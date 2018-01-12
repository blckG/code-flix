import {Component} from '@angular/core';
import {NavController} from 'ionic-angular';
import {Auth} from "../../decorators/auth.decorator";
import 'rxjs/add/operator/toPromise';

@Auth()
@Component({
    selector: 'page-home',
    templateUrl: 'home.html'
})
export class HomePage {

    constructor(public navCtrl: NavController) {}

}
