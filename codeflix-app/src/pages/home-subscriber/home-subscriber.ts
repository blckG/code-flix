import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import {VideoResource} from "../../providers/resources/video.resource";
import {FormControl} from "@angular/forms";
import "rxjs/add/operator/debounceTime";
import {Auth} from "../../decorators/auth.decorator";

/**
 * Generated class for the HomeSubscriberPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */
 //@Auth()
 @Component({
 	selector: 'page-home-subscriber',
 	templateUrl: 'home-subscriber.html',
 })
 export class HomeSubscriberPage {

 	videos = {
 	    data: []
    };
 	page = 1;
 	canMoreVideos: boolean = true;
 	canShowSearchBar: boolean = false;
 	search: string = "";
    formSearchControl = new FormControl();
 	constructor(public navCtrl: NavController, public navParams: NavParams, public videoResource: VideoResource) {
 	}

 	getVideos(){
        return this.videoResource.latest(this.page, this.search);
	}

 	ionViewDidLoad() {
 	    this.searchVideos();
		this.getVideos()
			.subscribe(videos => this.videos = videos);
 	}

 	searchVideos(){
 	    this.formSearchControl
            .valueChanges
            .debounceTime(1000)
            .subscribe(() => {
            	if(this.search == "" && !this.search){
            		return;
				}
                this.reset();
                this.getVideos()
                    .subscribe(videos => this.videos = videos);
            });

    }

 	doRefresh(refresh){
 		this.reset();
        this.getVideos()
            .subscribe(videos => {
            	this.videos = videos;
            	refresh.complete();
            }, () => refresh.complete());
	}

	doInfinite(infiniteScroll){
 	    this.page++;
        this.getVideos()
            .subscribe(videos => {
                this.videos.data = this.videos.data.concat(videos.data);
                if(videos.data.length == 0){
                	this.canMoreVideos = false;
				}
                infiniteScroll.complete();
            }, () => infiniteScroll.complete());
    }

    reset(){
        this.page = 1;
        this.canMoreVideos = true;
    }

 }
