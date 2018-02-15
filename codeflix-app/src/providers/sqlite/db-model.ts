import {DB} from "./db";
import {Injectable} from "@angular/core";
import objectValues from "object.values";

@Injectable()
export abstract class DbModel {

    protected abstract table: string;

    constructor(public db: DB){}

    insert(params: Object): Promise<any> {
        let columns = Object.keys(params);
        columns.map((value) =>{
           return `\`${value}\``;
        });
        let tokens = "?,".repeat(columns.length);
        tokens = tokens.substring(0, tokens.length - 1);
        let sql = `INSERT INTO \`${this.table}\`(${columns.join(',')}) VALUES(${tokens})`;
        console.log(sql);
        return this.db.executeSql(sql, objectValues(params));
    }

    find(id): Promise<any> {
        let sql = `SELECT * FROM \`${this.table}\` WHERE id = ?`;
        return this.db.executeSql(sql, [id])
            .then(resultSet => {
               return resultSet.rows.length ? resultSet.rows.item(0) : null;
            });
    }

    findByField(field: string, value): Promise<any> {
        let sql = `SELECT * FROM \`${this.table}\` WHERE ${field} = ?`;
        return this.db.executeSql(sql, [value]);
    }
}