// import { Observable } from 'rxjs';
// import { RequisicaoPaginada } from '../model/requisicao-paginada';
// import { RespostaPaginada } from '../model/resposta-paginada';

// export interface IService<T> {
//   apiUrl: string;

//   /**
//    * Busca paginada com termo opcional
//    * @param termoBusca Texto para busca
//    * @param paginacao Informações de paginação
//    */
//   get(termoBusca?: string, paginacao?: RequisicaoPaginada): Observable<RespostaPaginada<T>>;

//   /**
//    * Busca por ID
//    * @param id Identificador do objeto
//    */
//   getById(id: number): Observable<T>;

//   /**
//    * Salva um objeto
//    * @param objeto Objeto a ser salvo
//    */
//   save(objeto: T): Observable<T>;

//   /**
//    * Deleta um objeto por ID
//    * @param id Identificador do objeto
//    */
//   delete(id: number): Observable<void>;
// }
