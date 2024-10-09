package br.ufac.back_huerb.controller;

import br.ufac.back_huerb.model.Equipamento;
import br.ufac.back_huerb.service.EquipamentoService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/api/equipamentos")
public class EquipamentoController {

    @Autowired
    private EquipamentoService equipamentoService;

    @PostMapping("/cadastrar")
    public ResponseEntity<Equipamento> cadastrarEquipamento(@RequestBody Equipamento equipamento) {
        Equipamento novoEquipamento = equipamentoService.salvarEquipamento(equipamento);
        return ResponseEntity.ok(novoEquipamento);
    }

    @GetMapping
    public ResponseEntity<List<Equipamento>> listarEquipamentos() {
        return ResponseEntity.ok(equipamentoService.listarEquipamentos());
    }

    @DeleteMapping("/{id}")
    public ResponseEntity<Void> removerEquipamento(@PathVariable Long id) {
        equipamentoService.removerEquipamento(id);
        return ResponseEntity.noContent().build();
    }
}
