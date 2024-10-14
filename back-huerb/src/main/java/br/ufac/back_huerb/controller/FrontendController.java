package br.ufac.back_huerb.controller;

import org.springframework.stereotype.Controller;
import org.springframework.web.bind.annotation.GetMapping;

@Controller
public class FrontendController {

    @GetMapping("/home")
    public String home() {
        return "home"; // Retorna o arquivo home.html na pasta templates
    }

    @GetMapping("/login")
    public String login() {
        return "login"; // Retorna o arquivo login.html
    }

    @GetMapping("/cadastro")
    public String cadastro() {
        return "cadastro"; // Retorna o arquivo cadastro.html
    }

    @GetMapping("/aluguel")
    public String aluguel() {
        return "aluguel"; // Retorna o arquivo aluguel.html
    }

    @GetMapping("/estoque")
    public String estoque() {
        return "estoque";
    }

    @GetMapping("/relatorio")
    public String relatorio() {
        return "relatorio";
    }

    @GetMapping("/solicitacoes")
    public String solicitacoes() {
        return "solicitacoes";
    }
    

    // Adicione mais rotas conforme necessário para outras páginas
}
