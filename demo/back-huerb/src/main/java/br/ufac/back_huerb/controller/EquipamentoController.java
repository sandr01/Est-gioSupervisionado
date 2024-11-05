package br.ufac.back_huerb.controller;

import br.ufac.back_huerb.model.Equipamento;
import br.ufac.back_huerb.service.EquipamentoService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;
import java.time.LocalDate;


@RestController
@RequestMapping("/api/equipamentos")
public class EquipamentoController {

    @Autowired
    private EquipamentoService equipamentoService;

    @PostMapping("/cadastrar")
    public ResponseEntity<Equipamento> cadastrarEquipamento(@RequestBody Equipamento equipamento) {
        equipamento.setData(LocalDate.now());
        Equipamento novoEquipamento = equipamentoService.salvarEquipamento(equipamento);
        return ResponseEntity.ok(novoEquipamento);
    }

    @GetMapping("/listar")
    public ResponseEntity<List<Equipamento>> listarEquipamentos() {
        List<Equipamento> equipamentos = equipamentoService.listarEquipamentos();
        return ResponseEntity.ok(equipamentos);
    }

    @DeleteMapping("/{id}")
    public ResponseEntity<Void> removerEquipamento(@PathVariable Long id) {
        equipamentoService.removerEquipamento(id);
        return ResponseEntity.noContent().build();
    }
}
