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
 	page = 1;
 	constructor(public navCtrl: NavController, public navParams: NavParams, public videoResource: VideoResource) {
 	}

 	getVideos(){
        return this.videoResource.latest(this.page)
	}

 	ionViewDidLoad() {
		this.getVideos()
			.subscribe(videos => this.videos = videos);
 	}

 	doRefresh(refresh){
 		this.page = 1;
        this.getVideos()
            .subscribe(videos => {
            	this.videos = videos;
            	refresh.complete();
            }, () => refresh.complete());
	}

 }
