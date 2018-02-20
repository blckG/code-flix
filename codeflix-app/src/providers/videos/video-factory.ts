import {Injectable} from "@angular/core";
import {AppConfig} from "../app-config";
import {VideoResource} from "../resources/video.resource";
import {VideoController} from "./video-controller";

@Injectable()
export class VideoFactory {

    constructor(
        public appConfig: AppConfig,
        public videoResource: VideoResource,
        public videoController: VideoController
    ){}

    get(){
        return this.appConfig.getOff() ? this.videoController : this.videoResource;
    }
}