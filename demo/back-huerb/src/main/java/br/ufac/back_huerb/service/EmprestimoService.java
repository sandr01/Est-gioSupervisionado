package br.ufac.back_huerb.service;

import br.ufac.back_huerb.model.Emprestimo;
import br.ufac.back_huerb.repository.EmprestimoRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import java.util.List;

@Service
public class EmprestimoService {

    @Autowired
    private EmprestimoRepository emprestimoRepository;

    public Emprestimo salvarEmprestimo(Emprestimo emprestimo) {
        return emprestimoRepository.save(emprestimo);
    }

    public List<Emprestimo> listarEmprestimos() {
        return emprestimoRepository.findAll();
    }
}
