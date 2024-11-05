export interface relatorio {
  id: number;
  matricula: string;
  solicitante: string;
  equipamento: string;
  dataAluguel: Date;
  dataDevolucao: Date;
  status: string;
}
