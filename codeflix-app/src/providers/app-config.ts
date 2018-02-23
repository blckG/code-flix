import {Injectable} from "@angular/core";
import {Storage} from "@ionic/storage";

@Injectable()
export class AppConfig {

    private _off: boolean;
    private _appOffKey = 'app_off';
    private _baseFilePath = '/storage/sdcard1';
    private _appFileFolder = 'codeflix';

    constructor(public storage: Storage){}


    getOff(): boolean {
        return this._off;
    }

    setOff(value: boolean): Promise<any> {
        this._off = value;
        return this.storage.set(this._appOffKey, value);
    }

    load(): Promise<any> {
        return this.storage.get(this._appOffKey)
            .then(off => this._off = off);
    }

    getAppFilePath(){
        return `${this._baseFilePath}/${this._appFileFolder}`;
    }
}