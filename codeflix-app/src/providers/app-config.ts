import {Injectable} from "@angular/core";
import {Storage} from "@ionic/storage";

@Injectable()
export class AppConfig {

    private _off: boolean;
    private _appOffKey = 'app_off';

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
}