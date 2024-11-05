package br.ufac.back_huerb.repository;

import br.ufac.back_huerb.model.Emprestimo;
import org.springframework.data.jpa.repository.JpaRepository;

public interface EmprestimoRepository extends JpaRepository<Emprestimo, Long> {
}
