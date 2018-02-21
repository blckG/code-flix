import {Injectable} from "@angular/core";
import {Observable} from "rxjs/Observable";
import {VideoResource} from "../resources/video.resource";

@Injectable()
export class VideoDownload{

    videos: Array<any> = [];

    constructor(public videoResource: VideoResource){}

    addVideo(videoId): Observable<Object> {
        return this.videoResource
            .get(videoId)
            .map(video => {
                this.videos.push(video);
                console.log(video);
                return video;
            })
    }
}