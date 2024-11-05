import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import { HomeComponent } from './component/home/home.component';
import { SolicitacoesComponent } from './component/solicitacoes/solicitacoes.component';
import { RelatorioComponent } from './component/relatorio/relatorio.component';
const routes: Routes = [
  { path: '', redirectTo: '/home', pathMatch: 'full' }, 
  { path: 'home', component: HomeComponent },
  { path: 'solicitacoes', component: SolicitacoesComponent },
  { path: 'relatorio', component: RelatorioComponent },
  { path: '**', redirectTo: '/home' } 
];

@NgModule({
  imports: [RouterModule.forRoot(routes)], 
  exports: [RouterModule]
})
export class AppRoutingModule {}
