import { Component, ViewChild } from '@angular/core';
import { Nav, Platform } from 'ionic-angular';
import { StatusBar } from '@ionic-native/status-bar';
import { SplashScreen } from '@ionic-native/splash-screen';

import { HomePage } from '../pages/home/home';
import {LoginPage} from "../pages/login/login";
import {Auth} from "../providers/auth/auth";
import {Redirector} from "../providers/redirector";
import {UserSettingsPage} from "../pages/user-settings/user-settings";
import md5 from "crypto-md5";
import {DB} from "../providers/sqlite/db";
import {UserModel} from "../providers/sqlite/user.model";
import {AuthOffline} from "../providers/auth/auth-offline";
import {VideoModel} from "../providers/sqlite/video.model";

@Component({
  templateUrl: 'app.html'
})
export class MyApp {
  @ViewChild(Nav) nav: Nav;

  rootPage: any = LoginPage;
  user: any;
  gravatarUrl: string = "https://www.gravatar.com/avatar/nouser.jpg";

  pages: Array<{title: string, component: any}>;
  pagesSubscriber: Array<{title: string, component: any}>;

  constructor(public platform: Platform,
              public statusBar: StatusBar,
              public splashScreen: SplashScreen,
              public auth: Auth,
              public authOffline: AuthOffline,
              public redirector: Redirector,
              public db: DB,
              public userModel: UserModel,
              public videoModel: VideoModel) {
    this.initializeApp();

    // used for an example of ngFor and navigation
    this.pages = [
      { title: 'Home', component: HomePage },
      { title: 'Alterar senha', component: UserSettingsPage }
    ];

    this.pagesSubscriber = [
        { title: 'Home', component: HomePage },
        { title: 'Alterar senha', component: UserSettingsPage },
        { title: 'Minhas Assinaturas', component: 'SubscriptionPage' },
        { title: 'Área do assinante', component: 'HomeSubscriberPage' },
        { title: 'Downloads', component: 'DownloadsPage' },
    ]

  }

  initializeApp() {
    this.auth.userSubject().subscribe(user => {
      this.user = user;
      this.gravatar();
    });

      this.authOffline.userSubject().subscribe(user => {
          this.user = user;
          this.gravatar();
      });

    this.platform.ready().then(() => {
      this.db.createSchema();
      this.videoModel.latest(1, "s");
      // Okay, so the platform is ready and our plugins are available.
      // Here you can do any higher level native things you might need.
      this.statusBar.styleDefault();
      this.splashScreen.hide();
    });
  }

  ngAfterViewInit(){
      this.redirector.config(this.nav);
  }

  gravatar(){
    if(this.user) {
        this.gravatarUrl = `https://www.gravatar.com/avatar/${md5(this.user.email, 'hex')}.jpg`;
    }
  }

  openPage(page) {
    // Reset the content nav to have just this page
    // we wouldn't want the back button to show in this scenario
    this.nav.setRoot(page.component);
  }

  logout(){
    this.auth.logout().then(() => {
       this.nav.setRoot(LoginPage);
    })
  }
}
