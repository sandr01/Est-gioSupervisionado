package br.ufac.back_huerb.service;

import br.ufac.back_huerb.model.Equipamento;
import br.ufac.back_huerb.repository.EquipamentoRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;
import java.util.Optional;

@Service
public class EquipamentoService {

    @Autowired
    private EquipamentoRepository equipamentoRepository;

    public Equipamento salvarEquipamento(Equipamento equipamento) {
        return equipamentoRepository.save(equipamento);
    }

    public List<Equipamento> listarEquipamentos() {
        return equipamentoRepository.findAll();
    }

    public Optional<Equipamento> buscarEquipamentoPorId(Long id) {
        return equipamentoRepository.findById(id);
    }

    public void removerEquipamento(Long id) {
        equipamentoRepository.deleteById(id);
    }

    public Equipamento atualizarEquipamento(Long id, Equipamento equipamentoAtualizado) {
        return equipamentoRepository.findById(id)
            .map(equipamento -> {
                equipamento.setEquipamento(equipamentoAtualizado.getEquipamento());
                equipamento.setQuantidade(equipamentoAtualizado.getQuantidade());
                equipamento.setDescricao(equipamentoAtualizado.getDescricao());
                return equipamentoRepository.save(equipamento);
            })
            .orElseThrow(() -> new RuntimeException("Equipamento não encontrado"));
    }
}