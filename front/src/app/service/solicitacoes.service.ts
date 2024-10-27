import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class SolicitacoesService {
  private apiUrl = 'http://localhost:9000/api/solicitacoes';

  constructor(private http: HttpClient) { }

  listarSolicitacoes(): Observable<any> {
    return this.http.get(`${this.apiUrl}/listar`);
  }

  listarSolicitacoesAprovadas(): Observable<any> {
    return this.http.get(`${this.apiUrl}/aprovadas`);
  }

  atualizarStatusSolicitacao(id: string, status: string): Observable<any> {
    return this.http.put(`${this.apiUrl}/atualizar/${id}`, { status });
  }

  marcarComoDevolvido(id: string): Observable<any> {
    return this.http.put(`${this.apiUrl}/marcarDevolvido/${id}`, {});
  }
}
