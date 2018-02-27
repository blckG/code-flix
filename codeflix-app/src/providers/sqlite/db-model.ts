import {DB} from "./db";
import {Injectable} from "@angular/core";
import objectValues from "object.values";
import squel from "squel";

@Injectable()
export abstract class DbModel {

    protected abstract table: string;
    protected qb;

    constructor(public db: DB) {
    }

    insert(params: Object): Promise<any> {
        let columns = Object.keys(params);
        columns.map((value) => {
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

    paginate(page, perPage = 15): Promise<any> {
        this.initQueryBuilder();
        let offset = (page - 1) * perPage;
        if(typeof this.qb.VERSION != "undefined") {
            this.qb = this.qb.select();
        }
        this.qb = this.qb
            .from(this.table)
            .limit(perPage);
        if(offset != 0) {
            this.qb = this.qb.offset(offset);
        }
        let sqlObj = this.qb.toParam();
        this.qb = null;
        //console.log("texto: "+sqlObj.text);
        //console.log("valores: "+sqlObj.values);
        return this.db
            .executeSql(sqlObj.text, sqlObj.values)
            .then(resultset => {
                let rows = [];
                for (let i = 0; i < resultset.rows.length; i++){
                    rows.push(resultset.rows.item(i));
                }
                return rows;
            });
    }

    protected initQueryBuilder() {
        if (!this.qb) {
            this.qb = squel;
        }
    }
}