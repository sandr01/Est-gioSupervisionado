import { Component, OnInit } from '@angular/core';
import { EquipamentoService } from '../../service/equipamento.service';
import { CommonModule } from '@angular/common'; 

@Component({
  selector: 'app-estoque',
  standalone: true,
  imports: [CommonModule], 
  templateUrl: './estoque.component.html',
  styleUrls: ['./estoque.component.css']
})
export class EstoqueComponent implements OnInit {
  equipamentos: any[] = []; 

  constructor(private equipamentoService: EquipamentoService) {}

  ngOnInit(): void {
    this.carregarEquipamentos();
  }

  carregarEquipamentos(): void {
    this.equipamentoService.listarEquipamentos().subscribe({
      next: (data) => {
        this.equipamentos = data;
      },
      error: (error) => {
        console.error("Erro ao buscar equipamentos:", error);
      }
    });
  }
}
