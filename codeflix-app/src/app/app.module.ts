import {BrowserModule} from '@angular/platform-browser';
import {ErrorHandler, NgModule} from '@angular/core';
import {IonicApp, IonicErrorHandler, IonicModule} from 'ionic-angular';
import {Http, HttpModule, XHRBackend} from "@angular/http";

import {Env} from "../models/env";
import {MyApp} from './app.component';
import {HomePage} from '../pages/home/home';
import {ListPage} from '../pages/list/list';
import {LoginPage} from "../pages/login/login";
import {UserSettingsPage} from "../pages/user-settings/user-settings";
import {HomeSubscriberPage} from "../pages/home-subscriber/home-subscriber";
import {AddCpfPage} from "../pages/add-cpf/add-cpf";
import {PlansPage} from "../pages/plans/plans";
import {PaymentPage} from "../pages/payment/payment";
import {SubscriptionPage} from "../pages/subscription/subscription";
import {VideoPlayPage} from "../pages/video-play/video-play";


import {JwtClient} from "../providers/jwt-client";
import {Auth} from "../providers/auth";
import {DefaultXHRBackend} from "../providers/default-xhr-backend";
import {Redirector} from "../providers/redirector";
import {DB} from "../providers/sqlite/db";

import {UserResource} from "../providers/resources/user.resource";
import {PlanResource} from "../providers/resources/plan.resource";
import { PaymentResource } from '../providers/resources/payment.resource';
import { VideoResource } from '../providers/resources/video.resource';

import {IonicStorageModule, Storage} from "@ionic/storage";
import {AuthConfig, AuthHttp, JwtHelper} from "angular2-jwt";
import {TextMaskModule} from "angular2-text-mask";
import {StreamingMedia} from "@ionic-native/streaming-media";
import {Facebook} from "@ionic-native/facebook";
import {MomentModule} from "angular2-moment";
import {StatusBar} from '@ionic-native/status-bar';
import {SplashScreen} from '@ionic-native/splash-screen';
import {SQLite} from "@ionic-native/sqlite";
import {SQLitePorter} from "@ionic-native/sqlite-porter";


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
    AddCpfPage,
    SubscriptionPage,
    VideoPlayPage,
    ],
    imports: [
    BrowserModule,
    HttpModule,
    TextMaskModule,
    MomentModule,
    IonicModule.forRoot(MyApp, {}, {
        links: [
        {component: LoginPage,name: 'LoginPage', segment: 'login'},
        {component: HomePage,name: 'HomePage', segment: 'home'},
        {component: UserSettingsPage ,name: 'UserSettingsPage', segment: 'user-settings'},
        {component: HomeSubscriberPage ,name: 'HomeSubscriberPage', segment: 'home-subscriber'},
        {component: AddCpfPage ,name: 'AddCpfPage', segment: 'add-cpf'},
        {component: PlansPage ,name: 'PlansPage', segment: 'plans'},
        {component: PaymentPage ,name: 'PaymentPage', segment: 'plan/:plan/payment'},
        {component: SubscriptionPage ,name: 'SubscriptionPage', segment: 'subscriptions'},
        {component: VideoPlayPage ,name: 'VideoPlayPage', segment: 'video/:video/play'}
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
    AddCpfPage,
    SubscriptionPage,
    VideoPlayPage,
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
    PlanResource,
    PaymentResource,
    VideoResource,
    StreamingMedia,
    SQLite,
    SQLitePorter,
    DB,
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
