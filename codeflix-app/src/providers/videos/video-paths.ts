import {Injectable} from "@angular/core";
import {AppConfig} from "../app-config";
import md5 from "crypto-md5";

@Injectable()
export class VideoPaths {

    private _videosDir: string = 'videos';
    private _videosPath: string;

    constructor(public appConfig: AppConfig){
        this._videosPath = `${this.appConfig.getAppFilePath()}/${this._videosDir}`;
        //console.log(this._videosPath);
    }

    getFilePath(video) {
        return `${this._videosPath}/${video.id}/${md5(video.title, 'hex')}.mp4`;
    }

    getThumbPath(video) {
        return `${this._videosPath}/${video.id}/${md5(video.title, 'hex')}.jpg`;
    }


}