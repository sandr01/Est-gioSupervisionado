import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class AluguelService {
  private apiUrl = 'http://localhost:9000/api/aluguel';

  constructor(private http: HttpClient) {}

  getAlugueis(): Observable<any> {
    return this.http.get(`${this.apiUrl}/listar`);
  }

  criarAluguel(aluguelData: any): Observable<any> {
    return this.http.post(`${this.apiUrl}/criar`, aluguelData);
  }

  atualizarAluguel(id: number, aluguelData: any): Observable<any> {
    return this.http.put(`${this.apiUrl}/atualizar/${id}`, aluguelData);
  }
}
