package br.ufac.back_huerb.repository;

import br.ufac.back_huerb.model.Solicitacao;
import br.ufac.back_huerb.model.StatusSolicitacao;
import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.stereotype.Repository;

import java.util.List;

@Repository
public interface SolicitacaoRepository extends JpaRepository<Solicitacao, Long> {
    List<Solicitacao> findByStatus(StatusSolicitacao status);
}