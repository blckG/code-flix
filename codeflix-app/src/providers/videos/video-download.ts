import {Injectable} from "@angular/core";
import {Observable} from "rxjs/Observable";
import {VideoResource} from "../resources/video.resource";
import {VideoModel} from "../sqlite/video.model";
import {VideoPaths} from "./video-paths";

@Injectable()
export class VideoDownload{

    videos: Array<any> = [];

    constructor(public videoResource: VideoResource, public videoModel: VideoModel, public videoPaths: VideoPaths){}

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

    start(index){
        this.insertVideo(this.videos[index]);
    }

    protected insertVideo(video) {
        this.videoModel.insert({
            id: video.id,
            title: video.title,
            description: video.description,
            duration: video.duration,
            thumb_url: video.thumb_small_url,
            file_url: video.file_url,
            serie_title: video.serie_title,
            categories_name: JSON.stringify(video.categories_name),
            created_at: video.created_at.replace('T', ' ')
        });

    }
}