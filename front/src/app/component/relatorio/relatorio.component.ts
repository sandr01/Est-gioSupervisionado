import { Component, OnInit } from '@angular/core';
import { RelatorioService } from '../../service/relatorio.service';
import { CommonModule, DatePipe } from '@angular/common';

@Component({
  selector: 'app-relatorio',
  templateUrl: './relatorio.component.html',
  styleUrls: ['./relatorio.component.css'],
  providers: [DatePipe]
})
export class RelatorioComponent implements OnInit {
  solicitacoesAprovadas: any[] = [];

  constructor(private relatorioService: RelatorioService, private datePipe: DatePipe) { }

  ngOnInit(): void {
    this.carregarSolicitacoesAprovadas();
  }

  carregarSolicitacoesAprovadas(): void {
    this.relatorioService.listarSolicitacoesAprovadas().subscribe({
      next: (data) => {
        this.solicitacoesAprovadas = data.map((solicitacao: { data_aluguel: string | number | Date; data_devolucao: string | number | Date; }) => ({
          ...solicitacao,
          dataAluguel: this.datePipe.transform(solicitacao.data_aluguel, 'dd/MM/yyyy'),
          dataDevolucao: this.datePipe.transform(solicitacao.data_devolucao, 'dd/MM/yyyy')
        }));
      },
      error: (error) => console.error("Erro ao carregar solicitações aprovadas:", error)
    });
  }

  marcarComoDevolvido(id: string): void {
    this.relatorioService.marcarComoDevolvido(id).subscribe({
      next: () => this.carregarSolicitacoesAprovadas(),
      error: (_error) => alert("Erro ao marcar como devolvido.")
    });
  }
}
