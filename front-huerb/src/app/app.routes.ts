import { NgModule } from '@angular/core';
import { AluguelComponent } from './aluguel/aluguel.component';
import { CadastroComponent } from './cadastro/cadastro.component';
import { EstoqueComponent } from './estoque/estoque.component';
import { HomeComponent } from './home/home.component';
import { RelatorioComponent } from './relatorio/relatorio.component';
import { SolicitacoesComponent } from './solicitacoes/solicitacoes.component';
import { Routes, RouterModule } from '@angular/router';
import { LoginComponent } from './login/login.component';


export const routes: Routes = [
  { path: '', component: LoginComponent }, // Página inicial
  { path: 'aluguel', component: AluguelComponent },
  { path: 'cadastro', component: CadastroComponent },
  { path: 'estoque', component: EstoqueComponent },
  { path :'home', component: HomeComponent},
  { path: 'relatorio', component: RelatorioComponent },
  { path: 'solicitacoes', component: SolicitacoesComponent }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
