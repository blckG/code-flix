import {BrowserModule} from '@angular/platform-browser';
import {ErrorHandler, NgModule} from '@angular/core';
import {IonicApp, IonicErrorHandler, IonicModule} from 'ionic-angular';

import {MyApp} from './app.component';
import {HomePage} from '../pages/home/home';
import {ListPage} from '../pages/list/list';

import {StatusBar} from '@ionic-native/status-bar';
import {SplashScreen} from '@ionic-native/splash-screen';
import {LoginPage} from "../pages/login/login";
import {HttpClientModule} from "@angular/common/http";
import {JwtClient} from "../providers/jwt-client";
import {IonicStorageModule} from "@ionic/storage";
import {JwtHelper} from "angular2-jwt";
import {Auth} from "../providers/auth";

@NgModule({
    declarations: [
        MyApp,
        HomePage,
        ListPage,
        LoginPage
    ],
    imports: [
        BrowserModule,
        HttpClientModule,
        IonicModule.forRoot(MyApp),
        IonicStorageModule.forRoot({
            driverOrder: ['localstorage']
        })
    ],
    bootstrap: [IonicApp],
    entryComponents: [
        MyApp,
        HomePage,
        ListPage,
        LoginPage
    ],
    providers: [
        StatusBar,
        SplashScreen,
        JwtClient,
        Auth,
        JwtHelper,
        {provide: ErrorHandler, useClass: IonicErrorHandler}
    ]
})
export class AppModule {
}
