package br.ufac.back_huerb.service;

import br.ufac.back_huerb.model.Solicitacao;
import br.ufac.back_huerb.model.StatusSolicitacao;
import br.ufac.back_huerb.repository.SolicitacaoRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class SolicitacaoService {

    @Autowired
    private SolicitacaoRepository solicitacaoRepository;

    // Cria uma nova solicitação
    public Solicitacao criarSolicitacao(Solicitacao solicitacao) {
        solicitacao.setStatus(StatusSolicitacao.PENDENTE);
        return solicitacaoRepository.save(solicitacao);
    }

    // Lista todas as solicitações
    public List<Solicitacao> listarSolicitacoes() {
        return solicitacaoRepository.findAll();
    }

    // Atualiza o status de uma solicitação
    public Solicitacao atualizarStatus(Long id, StatusSolicitacao novoStatus) {
        Solicitacao solicitacao = solicitacaoRepository.findById(id)
                .orElseThrow(() -> new RuntimeException("Solicitação não encontrada"));
        solicitacao.setStatus(novoStatus);
        return solicitacaoRepository.save(solicitacao);
    }

    // Lista apenas as solicitações aprovadas (relatório)
    public List<Solicitacao> listarSolicitacoesAprovadas() {
        return solicitacaoRepository.findByStatus(StatusSolicitacao.APROVADO);
    }
}
