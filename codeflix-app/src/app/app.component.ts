import { Component, ViewChild } from '@angular/core';
import { Nav, Platform } from 'ionic-angular';
import { StatusBar } from '@ionic-native/status-bar';
import { SplashScreen } from '@ionic-native/splash-screen';

import { HomePage } from '../pages/home/home';
import { ListPage } from '../pages/list/list';
import {LoginPage} from "../pages/login/login";
import {Auth} from "../providers/auth";
import {Redirector} from "../providers/redirector";
import {UserSettingsPage} from "../pages/user-settings/user-settings";
import md5 from "crypto-md5";

@Component({
  templateUrl: 'app.html'
})
export class MyApp {
  @ViewChild(Nav) nav: Nav;

  rootPage: any = LoginPage;
  user: any;
  gravatarUrl: string = "https://www.gravatar.com/avatar/nouser.jpg";

  pages: Array<{title: string, component: any}>;

  constructor(public platform: Platform,
              public statusBar: StatusBar,
              public splashScreen: SplashScreen,
              public auth: Auth,
              public redirector: Redirector) {
    this.initializeApp();

    // used for an example of ngFor and navigation
    this.pages = [
      { title: 'Home', component: HomePage },
      { title: 'List', component: ListPage },
      { title: 'Alterar senha', component: UserSettingsPage }
    ];

  }

  initializeApp() {
    this.auth.userSubject().subscribe(user => {
      this.user = user;
      this.gravatar();
    });

    this.platform.ready().then(() => {
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
        this.gravatarUrl = `https://www.gravatar.com/avatar/${md5(this.user.email, 'hex')}`;
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
