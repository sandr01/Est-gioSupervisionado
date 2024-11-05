import { RouterModule, Routes } from '@angular/router';
import { AluguelComponent } from './component/aluguel/aluguel.component';
import { CadastroEquipamentoComponent } from './component/cadastro-equipamento/cadastro-equipamento.component';
import { CadastroUsuarioComponent } from './component/cadastro-usuario/cadastro-usuario.component';
import { EstoqueComponent } from './component/estoque/estoque.component';
import { HomeComponent } from './component/home/home.component';
import { LoginComponent } from './component/login/login.component';
import { RelatorioComponent } from './component/relatorio/relatorio.component';
import { SolicitacoesComponent } from './component/solicitacoes/solicitacoes.component';
import { NgModule } from '@angular/core';

export const routes: Routes = [
  { path: '', redirectTo: '/home', pathMatch: 'full' },    
  { path: 'home', component: HomeComponent },              
  { path: 'aluguel', component: AluguelComponent },        
  { path: 'cadastro-equipamento', component: CadastroEquipamentoComponent }, 
  { path: 'cadastro-usuario', component: CadastroUsuarioComponent }, 
  { path: 'estoque', component: EstoqueComponent },        
  { path: 'login', component: LoginComponent },            
  { path: 'relatorio', component: RelatorioComponent },    
  { path: 'solicitacoes', component: SolicitacoesComponent }, 
  { path: '**', redirectTo: '/home' }                      
];

@NgModule({
  imports: [RouterModule.forRoot(routes)], 
  exports: [RouterModule]
})
export class AppRoutingModule {}