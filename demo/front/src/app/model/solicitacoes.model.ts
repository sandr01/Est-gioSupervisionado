export interface solicitacoes {
    id: number;
    matricula: string;
    solicitante: string;
    equipamento: string;
    dataRetirada: Date;
    dataDevolucao: Date;
    status: string;
    descricao?: string;
  }
  