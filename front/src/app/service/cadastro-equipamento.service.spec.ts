import { TestBed } from '@angular/core/testing';

import { CadastroEquipamentoService } from './cadastro-equipamento.service';

describe('CadastroEquipamentoService', () => {
  let service: CadastroEquipamentoService;

  beforeEach(() => {
    TestBed.configureTestingModule({});
    service = TestBed.inject(CadastroEquipamentoService);
  });

  it('should be created', () => {
    expect(service).toBeTruthy();
  });
});
