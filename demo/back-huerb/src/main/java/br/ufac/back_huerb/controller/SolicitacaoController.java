package br.ufac.back_huerb.controller;

import br.ufac.back_huerb.model.Solicitacao;
import br.ufac.back_huerb.model.StatusSolicitacao;
import br.ufac.back_huerb.service.SolicitacaoService;

import java.util.Map;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.HttpStatus;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;
import java.time.LocalDate;

@RestController
@RequestMapping("/api/solicitacoes")
public class SolicitacaoController {

    @Autowired
    private SolicitacaoService solicitacaoService;

    // Endpoint para criar uma nova solicitação
    @PostMapping("/criar")
    public ResponseEntity<Solicitacao> criarSolicitacao(@RequestBody Solicitacao solicitacao) {
        Solicitacao novaSolicitacao = solicitacaoService.criarSolicitacao(solicitacao);
        return ResponseEntity.status(HttpStatus.CREATED).body(novaSolicitacao);
   }

    // Endpoint para listar todas as solicitações
    @GetMapping("/listar")
    public ResponseEntity<List<Solicitacao>> listarSolicitacoes() {
        return ResponseEntity.ok(solicitacaoService.listarSolicitacoes());
    }

    // Endpoint para atualizar o status da solicitação
    @PutMapping("/atualizar/{id}")
    public ResponseEntity<Solicitacao> atualizarStatus(@PathVariable Long id, @RequestBody StatusSolicitacao status) {
        Solicitacao solicitacaoAtualizada = solicitacaoService.atualizarStatus(id, status);
        return ResponseEntity.ok(solicitacaoAtualizada);
    }

    // Endpoint para listar as solicitações aprovadas (relatório)
    @GetMapping("/aprovadas")
    public ResponseEntity<List<Solicitacao>> listarSolicitacoesAprovadas() {
        return ResponseEntity.ok(solicitacaoService.listarSolicitacoesAprovadas());
    }

    // Endpoint para marcar como devolvido
    @PutMapping("/marcarDevolvido/{id}")
    public ResponseEntity<Solicitacao> marcarComoDevolvido(@PathVariable Long id) {
        Solicitacao solicitacaoAtualizada = solicitacaoService.marcarComoDevolvido(id);
        return ResponseEntity.ok(solicitacaoAtualizada);
    }
}
