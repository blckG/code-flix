import {Injectable} from "@angular/core";
import {Storage} from "@ionic/storage";
import {File} from "@ionic-native/file";

@Injectable()
export class AppConfig {

    private _off: boolean;
    private _appOffKey = 'app_off';
    private _baseFilePath = '/storage/sdcard1';
    private _appFileFolder = 'codeflix';

    constructor(public storage: Storage, public file: File){

    }


    getOff(): boolean {
        return this._off;
    }

    setOff(value: boolean): Promise<any> {
        this._off = value;
        return this.storage.set(this._appOffKey, value);
    }

   async load(): Promise<any> {
        let off = await this.storage.get(this._appOffKey);
        this._off = off;

        try{
            await this.file.resolveDirectoryUrl(`fiel://${this._baseFilePath}`);
        } catch (e){
            this._baseFilePath = this.file.externalApplicationStorageDirectory;
            console.log(e);
        }
        //console.log(this._baseFilePath);
        return Promise.resolve(null);
    }

    getAppFilePath(){
        return `${this._baseFilePath}/${this._appFileFolder}`;
    }
}