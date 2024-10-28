import { Component, OnInit } from '@angular/core';
import { SolicitacoesService } from '../../service/solicitacoes.service';


@Component({
  selector: 'app-solicitacoes',
  templateUrl: './solicitacoes.component.html',
  styleUrls: ['./solicitacoes.component.css']
})
export class SolicitacoesComponent implements OnInit {
  solicitacoes: any[] = [];

  constructor(private solicitacoesService: SolicitacoesService) { }

  ngOnInit(): void {
    this.carregarSolicitacoes();
  }

  carregarSolicitacoes(): void {
    this.solicitacoesService.listarSolicitacoes().subscribe({
      next: (data: any[]) => this.solicitacoes = data,
      error: (error: any) => console.error("Erro ao carregar solicitações:", error)
    });
  }

  atualizarStatus(id: string, status: string): void {
    this.solicitacoesService.atualizarStatusSolicitacao(id, status).subscribe({
      next: () => this.carregarSolicitacoes(),
      error: (error: any) => alert("Erro ao atualizar status.")
    });
  }
}
