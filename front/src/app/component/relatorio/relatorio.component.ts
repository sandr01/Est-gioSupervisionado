import { Component, OnInit } from '@angular/core';
import { SolicitacoesService } from '../solicitacoes.service';

@Component({
  selector: 'app-relatorio',
  templateUrl: './relatorio.component.html',
  styleUrls: ['./relatorio.component.css']
})
export class RelatorioComponent implements OnInit {
  solicitacoesAprovadas: any[] = [];

  constructor(private solicitacoesService: SolicitacoesService) { }

  ngOnInit(): void {
    this.carregarSolicitacoesAprovadas();
  }

  carregarSolicitacoesAprovadas(): void {
    this.solicitacoesService.listarSolicitacoesAprovadas().subscribe({
      next: (data) => this.solicitacoesAprovadas = data,
      error: (error) => console.error("Erro ao carregar solicitações aprovadas:", error)
    });
  }

  marcarComoDevolvido(id: string): void {
    this.solicitacoesService.marcarComoDevolvido(id).subscribe({
      next: () => this.carregarSolicitacoesAprovadas(),
      error: (error) => alert("Erro ao marcar como devolvido.")
    });
  }
}
