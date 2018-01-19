import {BrowserModule} from '@angular/platform-browser';
import {ErrorHandler, NgModule} from '@angular/core';
import {IonicApp, IonicErrorHandler, IonicModule} from 'ionic-angular';

import {MyApp} from './app.component';
import {HomePage} from '../pages/home/home';
import {ListPage} from '../pages/list/list';
import {UserSettingsPage} from "../pages/user-settings/user-settings";
import {HomeSubscriberPage} from "../pages/home-subscriber/home-subscriber";
import {AddCpfPage} from "../pages/add-cpf/add-cpf";
import {PlansPage} from "../pages/plans/plans";
import {PaymentPage} from "../pages/payment/payment";

import {StatusBar} from '@ionic-native/status-bar';
import {SplashScreen} from '@ionic-native/splash-screen';
import {LoginPage} from "../pages/login/login";
import {JwtClient} from "../providers/jwt-client";
import {IonicStorageModule, Storage} from "@ionic/storage";
import {AuthConfig, AuthHttp, JwtHelper} from "angular2-jwt";
import {Auth} from "../providers/auth";
import {Env} from "../models/env";
import {Http, HttpModule, XHRBackend} from "@angular/http";
import {DefaultXHRBackend} from "../providers/default-xhr-backend";
import {Redirector} from "../providers/redirector";
import {Facebook} from "@ionic-native/facebook";
import {UserResource} from "../providers/resources/user.resource";
import {TextMaskModule} from "angular2-text-mask";

declare var ENV: Env;

@NgModule({
    declarations: [
    MyApp,
    HomePage,
    ListPage,
    LoginPage,
    UserSettingsPage,
    HomeSubscriberPage,
    PaymentPage,
    PlansPage,
    AddCpfPage
    ],
    imports: [
    BrowserModule,
    HttpModule,
    TextMaskModule,
    IonicModule.forRoot(MyApp, {}, {
        links: [
        {component: LoginPage,name: 'LoginPage', segment: 'login'},
        {component: HomePage,name: 'HomePage', segment: 'home'},
        {component: UserSettingsPage ,name: 'UserSettingsPage', segment: 'user-settings'},
        {component: HomeSubscriberPage ,name: 'HomeSubscriberPage', segment: 'home-subscriber'},
        {component: AddCpfPage ,name: 'AddCpfPage', segment: 'add-cpf'},
        {component: PlansPage ,name: 'PlansPage', segment: 'plans'},
        {component: PaymentPage ,name: 'PaymentPage', segment: 'plan/:plan/payment'}
        ]
    }),
    IonicStorageModule.forRoot({
        driverOrder: ['localstorage']
    })
    ],
    bootstrap: [IonicApp],
    entryComponents: [
    MyApp,
    HomePage,
    ListPage,
    LoginPage,
    UserSettingsPage,
    HomeSubscriberPage,
    PaymentPage,
    PlansPage,
    AddCpfPage
    ],
    providers: [
    StatusBar,
    SplashScreen,
    JwtClient,
    Auth,
    JwtHelper,
    Redirector,
    Facebook,
    UserResource,
    {provide: ErrorHandler, useClass: IonicErrorHandler},
    {
        provide: AuthHttp,
        deps: [Http, Storage],
        useFactory(http, storage){
            let authConfig = new AuthConfig({
                headerPrefix: 'Bearer',
                noJwtError: true,
                noClientCheck: true,
                tokenGetter: (() => storage.get(ENV.TOKEN_NAME))
            });
            return new AuthHttp(authConfig, http);
        }
    },
    {provide: XHRBackend, useClass: DefaultXHRBackend},
    ]
})
export class AppModule {
}
