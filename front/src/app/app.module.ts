import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { HttpClientModule } from '@angular/common/http';

import { AppComponent } from './app.component';
import { AppRoutingModule } from './app-routing.module'; // Importação do módulo de rotas
import { SolicitacoesComponent } from './component/solicitacoes/solicitacoes.component';
import { RelatorioComponent } from './component/relatorio/relatorio.component';
import { SolicitacoesService } from './service/solicitacoes.service';

@NgModule({
  declarations: [
    AppComponent,
    SolicitacoesComponent,
    RelatorioComponent
  ],
  imports: [
    BrowserModule,
    AppRoutingModule, // Inclui o módulo de rotas
    HttpClientModule
  ],
  providers: [SolicitacoesService],
  bootstrap: [AppComponent]
})
export class AppModule { }
