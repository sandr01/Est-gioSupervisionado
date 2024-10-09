package br.ufac.back_huerb.controller;

import br.ufac.back_huerb.model.Solicitacao;
import br.ufac.back_huerb.service.SolicitacaoService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/api/solicitacoes")
public class SolicitacaoController {

    @Autowired
    private SolicitacaoService solicitacaoService;

    @PostMapping("/cadastrar")
    public ResponseEntity<Solicitacao> cadastrarSolicitacao(@RequestBody Solicitacao solicitacao) {
        Solicitacao novaSolicitacao = solicitacaoService.salvarSolicitacao(solicitacao);
        return ResponseEntity.ok(novaSolicitacao);
    }

    @GetMapping
    public ResponseEntity<List<Solicitacao>> listarSolicitacoes() {
        return ResponseEntity.ok(solicitacaoService.listarSolicitacoes());
    }

    @PutMapping("/{id}/status")
    public ResponseEntity<Solicitacao> atualizarStatusSolicitacao(
            @PathVariable Long id, @RequestParam String status) {
        Solicitacao solicitacaoAtualizada = solicitacaoService.atualizarStatus(id, status);
        return ResponseEntity.ok(solicitacaoAtualizada);
    }
}
