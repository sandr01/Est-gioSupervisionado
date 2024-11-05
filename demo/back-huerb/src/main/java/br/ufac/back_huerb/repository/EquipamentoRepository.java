package br.ufac.back_huerb.repository;

import br.ufac.back_huerb.model.Equipamento;
import org.springframework.data.jpa.repository.JpaRepository;

public interface EquipamentoRepository extends JpaRepository<Equipamento, Long> {
}
