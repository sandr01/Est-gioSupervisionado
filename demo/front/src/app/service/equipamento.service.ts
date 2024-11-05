import { Injectable } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class EquipamentoService {
  private apiUrl = 'http://localhost:9000/api/equipamentos/listar';

  constructor(private http: HttpClient) {}

  listarEquipamentos(): Observable<any[]> {
    return this.http.get<any[]>(this.apiUrl);
  }
}
