import {BehaviorSubject} from "rxjs/BehaviorSubject";


  export interface AuthGuard {


    user(): Promise<Object>;

    userSubject(): BehaviorSubject<Object>;

    login({email, password}): Promise<Object>;

    check(): Promise<boolean>;

    logout(): Promise<any>;

  }
