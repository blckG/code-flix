import {Component, Input, OnInit} from '@angular/core';

/**
 * Generated class for the ProgressBarComponent component.
 *
 * See https://angular.io/api/core/Component for more info on Angular
 * Components.
 */
@Component({
  selector: 'progress-bar',
  templateUrl: 'progress-bar.html'
})
export class ProgressBarComponent implements OnInit{

  @Input('color') color: string;
  @Input('progress') progress: string;

    ngOnInit(): void {
      if(!this.color){
        this.color = 'primary';
      }

    }


}
