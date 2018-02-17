import {Injectable} from "@angular/core";

@Injectable()
export class AppConfig {

    private _off: boolean;


    getOff(): boolean {
        return this._off;
    }

    setOff(value: boolean) {
        this._off = value;
    }
}