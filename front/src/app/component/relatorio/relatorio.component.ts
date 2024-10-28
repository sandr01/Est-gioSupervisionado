import { Component, OnInit } from '@angular/core';
import { RelatorioService } from '../../service/relatorio.service';

@Component({
  selector: 'app-relatorio',
  templateUrl: './relatorio.component.html',
  styleUrls: ['./relatorio.component.css']
})
export class RelatorioComponent implements OnInit {
  solicitacoesAprovadas: any[] = [];

  constructor(private relatorioService: RelatorioService) { }

  ngOnInit(): void {
    this.carregarSolicitacoesAprovadas();
  }

  carregarSolicitacoesAprovadas(): void {
    this.relatorioService.listarSolicitacoesAprovadas().subscribe({
      next: (data) => this.solicitacoesAprovadas = data,
      error: (error) => console.error("Erro ao carregar solicitações aprovadas:", error)
    });
  }

  marcarComoDevolvido(id: string): void {
    this.relatorioService.marcarComoDevolvido(id).subscribe({
      next: () => this.carregarSolicitacoesAprovadas(),
      error: (error) => alert("Erro ao marcar como devolvido.")
    });
  }
}
