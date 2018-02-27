import { Component } from '@angular/core';
import { NavController, NavParams } from 'ionic-angular';
import {Auth} from "../../decorators/auth.decorator";
import {VideoDownload} from "../../providers/videos/video-download";

/**
 * Generated class for the DownloadsPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */

@Auth()
@Component({
  selector: 'page-downloads',
  templateUrl: 'downloads.html',
})
export class DownloadsPage {

  videos: Array<any>;

  constructor(public navCtrl: NavController, public navParams: NavParams, public videoDownload: VideoDownload) {
    this.videos = this.videoDownload.videos;
  }

  ionViewDidLoad() {
    /*let count = 0;
    setInterval(() => {
        count++;
      this.progress = `${count}%`;
    }, 200);*/
  }

  download(index){
    this.videoDownload.start(index);
  }

}
