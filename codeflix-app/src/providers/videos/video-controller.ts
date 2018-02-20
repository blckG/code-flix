import {VideoAdapter} from "./video-adapter";
import {Observable} from "rxjs/Observable";
import {Injectable} from "@angular/core";
import {VideoModel} from "../sqlite/video.model";

@Injectable()
export class VideoController implements VideoAdapter{

    constructor(public videoModel: VideoModel){}

    latest(page: number, search: string): Observable<any> {
        return Observable.create(observer => {

        });
    }

    get(id: number): Observable<any> {
        return Observable.create(observer => {

        });
    }

}