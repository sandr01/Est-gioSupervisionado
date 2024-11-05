import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { HttpClientModule } from '@angular/common/http';
import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { RelatorioComponent } from './component/relatorio/relatorio.component';
import { SolicitacoesComponent } from './component/solicitacoes/solicitacoes.component';
import { SolicitacoesService } from './service/solicitacoes.service';

@NgModule({
  declarations: [
    AppComponent,
    SolicitacoesComponent,
    RelatorioComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    HttpClientModule
  ],
  providers: [
    SolicitacoesService
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }