import {Injectable} from '@angular/core';
import {SQLitePorter} from "@ionic-native/sqlite-porter";
import {SQLite, SQLiteObject} from "@ionic-native/sqlite";
import sql from "../../sql/db.sql";
import {Env} from "../../models/env";

declare var ENV: Env;

/*
  Generated class for the DB provider.

  See https://angular.io/guide/dependency-injection for more info on providers
  and Angular DI.
  */
@Injectable()
export class DB {

    constructor(public sqlitePorter: SQLitePorter, public sqlite: SQLite) {
    }

    private openOrCreateDatabase(): Promise<SQLiteObject> {
        return this.sqlite.create({
            name: ENV.DB_DATABASE,
            location: 'default'
        });
    }

    createSchema(): Promise<any> {
        return this.openOrCreateDatabase()
            .then((db: SQLiteObject) => {
                let dbInstance = db._objectInstance;
                return this.sqlitePorter
                    .importSqlToDb(dbInstance, sql)
                    .then(() => console.log('SQL imported'))
                    .catch(e => console.log(e));
            });
    }

    executeSql(sql: string, params: Array<any> = []): Promise<any> {
        return this.openOrCreateDatabase()
            .then((db: SQLiteObject) => {
                return db.executeSql(sql, params);
            })
    }

}
