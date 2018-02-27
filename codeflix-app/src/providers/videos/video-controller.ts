import {VideoAdapter} from "./video-adapter";
import {Observable} from "rxjs/Observable";
import {Injectable} from "@angular/core";
import {VideoModel} from "../sqlite/video.model";
import {Entry, File} from "@ionic-native/file";

@Injectable()
export class VideoController implements VideoAdapter {

    constructor(public videoModel: VideoModel, public file: File) {
    }

    latest(page: number, search: string): Observable<any> {
        return Observable.create(observer => {
            this.videoModel
                .latest(page, search)
                .then(rows => {
                    this.formatRows(rows)
                        .then(formattedRows => {
                        observer.next({
                            data: formattedRows
                        })
                    });

                })
                .catch(error => observer.error(error));

        });
    }

    get(id: number): Observable<any> {
        return Observable.create(observer => {

        });
    }

    protected async formatRows(rows) {
        for (let row of rows) {
            row.thumb_small_url = await this.getCdvFile(row.thumb_url);
            row.file_url = await this.getCdvFile(row.file_url);
            row.categories_name = {
                data:{
                    name: JSON.parse(row.categories_name)
                }
            };
            if(row.serie_title){
                row.serie_title = {
                    data: {
                        title: row.serie_title
                    }
                }
            }
        }

        return Promise.resolve(rows);
    }

    protected async getCdvFile(url) {
        let _url = url;
        if (_url.indexOf('file://') == -1) {
            _url = `file://${_url}`;
        }
        _url = await this.file
            .resolveLocalFilesystemUrl(_url)
            .then((entry: Entry) => entry.toInternalURL())

        return _url;
    }

}