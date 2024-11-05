import { TestBed } from '@angular/core/testing';
import { HttpClientTestingModule, HttpTestingController } from '@angular/common/http/testing';
import { AluguelService } from './aluguel.service';

describe('AluguelService', () => {
  let service: AluguelService;
  let httpMock: HttpTestingController;

  beforeEach(() => {
    TestBed.configureTestingModule({
      imports: [HttpClientTestingModule],
      providers: [AluguelService]
    });
    service = TestBed.inject(AluguelService);
    httpMock = TestBed.inject(HttpTestingController);
  });

  it('should retrieve alugueis from the API', () => {
    const dummyAlugueis = [{ id: 1, name: 'Aluguel 1' }, { id: 2, name: 'Aluguel 2' }];

    service.getAlugueis().subscribe(alugueis => {
      expect(alugueis.length).toBe(2);
      expect(alugueis).toEqual(dummyAlugueis);
    });

    const request = httpMock.expectOne(`${service['apiUrl']}/listar`);
    expect(request.request.method).toBe('GET');
    request.flush(dummyAlugueis);
  });

  afterEach(() => {
    httpMock.verify();
  });
});
