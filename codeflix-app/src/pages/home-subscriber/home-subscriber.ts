import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import {VideoResource} from "../../providers/resources/video.resource";

/**
 * Generated class for the HomeSubscriberPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

 @Component({
 	selector: 'page-home-subscriber',
 	templateUrl: 'home-subscriber.html',
 })
 export class HomeSubscriberPage {

 	videos = [];
 	constructor(public navCtrl: NavController, public navParams: NavParams, public videoResource: VideoResource) {
 	}

 	ionViewDidLoad() {
		this.videoResource
			.latest(1)
			.subscribe(videos => this.videos = videos);
 	}

 }
