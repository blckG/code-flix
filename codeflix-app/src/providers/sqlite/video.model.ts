import {Injectable} from "@angular/core";
import {DbModel} from "./db-model";
import {DB} from "./db";
import {Auth} from "../auth/auth";

@Injectable()
export class VideoModel extends DbModel{

    protected table = 'videos'

    constructor(public db: DB, public auth: Auth) {
        super(db);
    }

    insert(params: Object): Promise<any> {
        return this.auth.user().then((user) => {
            (<any>params).user_id = (<any>user).id;
            return super.insert(params);
        })
    }
}