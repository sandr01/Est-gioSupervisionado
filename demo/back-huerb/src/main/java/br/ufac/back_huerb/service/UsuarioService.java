package br.ufac.back_huerb.service;

import br.ufac.back_huerb.model.Usuario;
import br.ufac.back_huerb.repository.UsuarioRepository;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;

import jakarta.transaction.Transactional;
import java.util.List;

@Service
public class UsuarioService {

    @Autowired
    private UsuarioRepository usuarioRepository;

    // Método para buscar usuário pelo email
    public Usuario findByEmail(String email) {
        return usuarioRepository.findByEmail(email);
    }

    // Método para listar todos os usuários
    public List<Usuario> listarUsuarios() {
        return usuarioRepository.findAll();
    }

    public Usuario cadastrarUsuario(Usuario usuario) {
        if (usuario.getPassword() == null || usuario.getPassword().isEmpty()) {
            throw new IllegalArgumentException("A senha não pode ser nula.");
        }

        // Certifique-se de que o tipo está setado corretamente
        if (usuario.getUserType() == null || usuario.getUserType().isEmpty()) {
            usuario.setUserType("SOLICITANTE");  // Define um tipo padrão, se necessário
        }

        return usuarioRepository.save(usuario);
    }

    // Método para salvar um novo usuário e retornar o usuário salvo
    @Transactional
    public Usuario salvarUsuario(Usuario usuario) {
        // Verifica se o email já está registrado
        if (usuarioRepository.findByEmail(usuario.getEmail()) == null) {
            return usuarioRepository.save(usuario); // Salva o usuário no banco de dados
        } else {
            throw new IllegalArgumentException("E-mail já registrado!"); // Lança exceção se o e-mail já estiver em uso
        }
    }
}
