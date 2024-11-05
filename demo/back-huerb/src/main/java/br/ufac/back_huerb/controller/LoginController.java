package br.ufac.back_huerb.controller;

import br.ufac.back_huerb.model.Usuario;
import br.ufac.back_huerb.service.UsuarioService;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;

@RestController
@RequestMapping("/api")
public class LoginController {

    @Autowired
    private UsuarioService usuarioService;

    @PostMapping("/login")
    public ResponseEntity<?> login(@RequestBody LoginRequest loginRequest) {
        String email = loginRequest.getEmail();
        String password = loginRequest.getPassword();

        // Busca o usuário pelo email
        Usuario usuario = usuarioService.findByEmail(email);

        if (usuario != null && usuario.getPassword().equals(password)) {
            // Valida se a senha está correta e retorna o tipo de usuário
            return ResponseEntity.ok(new LoginResponse(true, usuario.getUserType()));
        } else {
            // Se não encontrar o usuário ou a senha estiver incorreta
            return ResponseEntity.status(401).body(new LoginResponse(false, null));
        }
    }

    // Classes auxiliares
    static class LoginRequest {
        private String email;
        private String password;

        // Getters e Setters
        public String getEmail() {
            return email;
        }

        public void setEmail(String email) {
            this.email = email;
        }

        public String getPassword() {
            return password;
        }

        public void setPassword(String password) {
            this.password = password;
        }
    }

    static class LoginResponse {
        private boolean success;
        private String userType;

        public LoginResponse(boolean success, String userType) {
            this.success = success;
            this.userType = userType;
        }

        // Getters e Setters
        public boolean isSuccess() {
            return success;
        }

        public void setSuccess(boolean success) {
            this.success = success;
        }

        public String getUserType() {
            return userType;
        }

        public void setUserType(String userType) {
            this.userType = userType;
        }
    }
}
