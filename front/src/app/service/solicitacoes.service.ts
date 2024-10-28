import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root' // ou registre no módulo se necessário
})
export class SolicitacoesService {
  private apiUrl = 'http://localhost:9000/api/solicitacoes';

  constructor(private http: HttpClient) { }

  listarSolicitacoes(): Observable<any> {
    return this.http.get(`${this.apiUrl}/listar`);
  }

  atualizarStatusSolicitacao(id: string, status: string): Observable<any> {
    return this.http.put(`${this.apiUrl}/atualizar/${id}`, { status });
  }
}
