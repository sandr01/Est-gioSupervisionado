import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root' // ou registrar manualmente no módulo
})
export class RelatorioService {
  private apiUrl = 'http://localhost:9000/api/solicitacoes';

  constructor(private http: HttpClient) { }

  listarSolicitacoesAprovadas(): Observable<any> {
    return this.http.get(`${this.apiUrl}/aprovadas`);
  }

  marcarComoDevolvido(id: string): Observable<any> {
    return this.http.put(`${this.apiUrl}/marcarDevolvido/${id}`, {});
  }
}
