import { Component } from '@angular/core';
import { RouterOutlet, RouterModule } from '@angular/router';  
import { CommonModule } from '@angular/common';
import { AlertaComponent } from './component/alerta/alerta.component';

@Component({
  selector: 'app-root',
  standalone: true,
  imports: [RouterOutlet, RouterModule, CommonModule, AlertaComponent], 
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  title = 'front';
  currentUrl = '/home'; 

  isLoggedIn(): boolean {
    
    return true;
  }
}
