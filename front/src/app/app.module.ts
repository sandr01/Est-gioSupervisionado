import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { HttpClientModule } from '@angular/common/http';
import { RouterModule } from '@angular/router'; 
import { AppComponent } from './app.component';
import { AppRoutingModule } from './app-routing.module';
import { RelatorioComponent } from './component/relatorio/relatorio.component';
import { SolicitacoesService } from './service/solicitacoes.service';
import { CommonModule } from '@angular/common';
import { SolicitacoesComponent } from './component/solicitacoes/solicitacoes.component';

@NgModule({
  declarations: [SolicitacoesComponent, RelatorioComponent],
  imports: [BrowserModule, AppRoutingModule, HttpClientModule, CommonModule,  RouterModule],
  providers: [SolicitacoesService],
  bootstrap: [AppComponent]
})
export class AppModule { }
