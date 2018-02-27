import {Component} from '@angular/core';
import {ActionSheetController, NavController, NavParams, ToastController} from 'ionic-angular';
import {FormControl} from "@angular/forms";
import "rxjs/add/operator/debounceTime";
import {Auth} from "../../decorators/auth.decorator";
import {VideoFactory} from "../../providers/videos/video-factory";
import {VideoAdapter} from "../../providers/videos/video-adapter";
import {VideoDownload} from "../../providers/videos/video-download";
import {AppConfig} from "../../providers/app-config";

/**
 * Generated class for the HomeSubscriberPage page.
 *
 * See https://ionicframework.com/docs/components/#navigation for more info on
 * Ionic pages and navigation.
 */
@Auth()
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
    videoAdapter: VideoAdapter;

    constructor(public navCtrl: NavController,
                public actionSheetCtrl: ActionSheetController,
                public toastCtrl: ToastController,
                public navParams: NavParams,
                public videoFactory: VideoFactory,
                public videoDownload: VideoDownload,
                public appConfig: AppConfig) {
        this.videoAdapter = this.videoFactory.get();
    }

    getVideos() {
        return this.videoAdapter.latest(this.page, this.search);
    }

    ionViewDidLoad() {
        this.searchVideos();
        this.getVideos()
            .subscribe(videos => this.videos = videos);
    }

    searchVideos() {
        this.formSearchControl
            .valueChanges
            .debounceTime(1000)
            .subscribe(() => {
                if (this.search == "" && !this.search) {
                    return;
                }
                this.reset();
                this.getVideos()
                    .subscribe(videos => this.videos = videos);
            });

    }

    doRefresh(refresh) {
        this.reset();
        this.getVideos()
            .subscribe(videos => {
                this.videos = videos;
                refresh.complete();
            }, () => refresh.complete());
    }

    doInfinite(infiniteScroll) {
        this.page++;
        this.getVideos()
            .subscribe(videos => {
                this.videos.data = this.videos.data.concat(videos.data);
                if (videos.data.length == 0) {
                    this.canMoreVideos = false;
                }
                infiniteScroll.complete();
            }, () => infiniteScroll.complete());
    }

    reset() {
        this.page = 1;
        this.canMoreVideos = true;
    }

    presentActionSheet(videoId) {
        let actionSheet = this.actionSheetCtrl.create({
            title: 'Opções',
            buttons: [
                {
                    text: 'Enviar para download',
                    role: 'destructive',
                    handler: () => {
                        this.addVideo(videoId, actionSheet);
                        return false;
                    }
                },
                {
                    text: 'Cancelar',
                    role: 'cancel',
                    handler: () => {
                        console.log('cancelou');
                    }
                }
            ]
        });

        actionSheet.present();
    }

    addVideo(videoId, actionSheet) {
        this.videoDownload
            .addVideo(videoId)
            .subscribe(
                () => actionSheet.dismiss(),
                () => {
                    actionSheet.dismiss();
                    let toast = this.toastCtrl.create({
                        message: 'Não foi possivel identificar o vídeo. Tente novamente',
                        duration: 3000,
                        position: 'bottom',
                        cssClass: 'toast-login-error'
                    });

                    toast.present();
                }
            )
    }

}
