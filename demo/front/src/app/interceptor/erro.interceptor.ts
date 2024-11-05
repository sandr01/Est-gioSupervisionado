import { HttpInterceptorFn } from '@angular/common/http';

const ERRO_HTTP: Record<number,string> = {
  401: 'Não Autorizado',
  403: 'Acesso Proibido',
  404: 'Recurso não Encontrado',
  500: 'Erro Interno do Servidor'
}

export const erroInterceptor: HttpInterceptorFn = (req, next) => {
  return next(req);
};
