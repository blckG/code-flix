import {Injectable} from "@angular/core";
import {DbModel} from "./db-model";
import {DB} from "./db";
import {Auth} from "../auth/auth";
import {AuthOffline} from "../auth/auth-offline";

@Injectable()
export class VideoModel extends DbModel{

    protected table = 'videos'

    constructor(public db: DB, public auth: Auth, public authOff: AuthOffline) {
        super(db);
    }

    insert(params: Object): Promise<any> {
        return this.auth.user().then((user) => {
            (<any>params).user_id = (<any>user).id;
            return super.insert(params);
        })
    }

    async latest(page, search){
        this.initQueryBuilder();
        let user = await this.authOff.user();
        let where = "user_id = ? AND (title LIKE ? OR description LIKE ? OR serie_title LIKE ? OR categories_name LIKE ?)";
        let likeSearch = `%${search}%`;
        this.qb
            .select()
            .where(where, (<any>user).id, likeSearch, likeSearch, likeSearch, likeSearch)
            .order('created_at');
        return super.paginate(page);
    }
}