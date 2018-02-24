import {Injectable, NgZone} from "@angular/core";
import {Observable} from "rxjs/Observable";
import {VideoResource} from "../resources/video.resource";
import {VideoModel} from "../sqlite/video.model";
import {VideoPaths} from "./video-paths";
import {FileTransfer} from "@ionic-native/file-transfer";

@Injectable()
export class VideoDownload{

    videos: Array<any> = [];

    constructor(
        public videoResource: VideoResource,
        public videoModel: VideoModel,
        public videoPaths: VideoPaths,
        public transfer: FileTransfer,
        public zone: NgZone){}

    addVideo(videoId): Observable<Object> {
        return this.videoResource
            .get(videoId)
            .map(video => {
                video.progress = '0%';
                this.videos.push(video);
                console.log(video);
                return video;
            })
    }

    start(index): Promise<any> {
        let fileTransfer = this.transfer.create();
        let video = this.videos[index];
        fileTransfer.onProgress((event: ProgressEvent) => {
            if(event.lengthComputable) {
                this.zone.run(() => {
                    let progress = (event.loaded/event.total)*100;
                    progress = Math.ceil(progress);
                    video.progress = `${progress}%`;
                });
            }
        });
        //http://sample-videos.com/video/mp4/720/big_buck_bunny_720p_10mb.mp4
        return fileTransfer.download(video.file_url, this.videoPaths.getFilePath(video))
            .then(() => {
                return this.transferThumb(video);
            })
            .then(() => {
                //consultar se vídeo existe ou não
                return this.insertVideo(this.videos[index]);
            })
            .catch(error => console.log(error));

    }

    protected transferThumb(video){
        let fileTransfer = this.transfer.create();
        return fileTransfer.download(video.thumb_small_url, this.videoPaths.getThumbPath(video));
    }

    protected insertVideo(video) {
        return this.videoModel.insert({
            id: video.id,
            title: video.title,
            description: video.description,
            duration: video.duration,
            thumb_url: this.videoPaths.getThumbPath(video),
            file_url: this.videoPaths.getFilePath(video),
            serie_title: video.serie_title,
            categories_name: JSON.stringify(video.categories_name),
            created_at: video.created_at.replace('T', ' ')
        });

    }
}