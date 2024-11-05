package br.ufac.back_huerb.controller;

import br.ufac.back_huerb.model.Emprestimo;
import br.ufac.back_huerb.service.EmprestimoService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

import java.util.List;

@RestController
@RequestMapping("/api/emprestimos")
public class EmprestimoController {

    @Autowired
    private EmprestimoService emprestimoService;

    @PostMapping("/cadastrar")
    public ResponseEntity<Emprestimo> cadastrarEmprestimo(@RequestBody Emprestimo emprestimo) {
        Emprestimo novoEmprestimo = emprestimoService.salvarEmprestimo(emprestimo);
        return ResponseEntity.ok(novoEmprestimo);
    }

    @GetMapping
    public ResponseEntity<List<Emprestimo>> listarEmprestimos() {
        return ResponseEntity.ok(emprestimoService.listarEmprestimos());
    }
}
