import {DbModel} from "./db-model";
import {Injectable} from "@angular/core";

@Injectable()
export class UserModel extends DbModel {

    protected table = 'users';

    save({id, name, email}): Promise<Object> {
        return this.findByField('email', email)
            .then(resultset => {
                if(!resultset.rows.length){
                    return this.insert({id, name, email});
                }
                return Promise.resolve(resultset);
            })
            .then(resultset => {
                return resultset.rows.item(0);
            })
    }
}