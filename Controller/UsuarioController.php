<?php

require_once "../Model/Usuario.php";
require_once "../Conexao/Conexao.php";
require_once "../Excecoes/AutenticarException.php";

class UsuarioController {
    private $db;

    public function __construct() {
        $this->db = Conexao::getConexao();
    }

    // Função para cadastrar um novo usuário
    public function cadastrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $usuario = new Usuario(
                $_POST['nome_usuario'],
                $_POST['email_usuario'],
                $_POST['cpf_usuario'],
                $_POST['contato_usuario'],
                $_POST['senha_usuario'],
                $_POST['data_nasc_usuario'],
                $_POST['setor_usuario'],
                $_POST['cargo_usuario']
            );

            try {
                $usuario->cadastrar($this->db);
                header('Location: ../View/adm.php');
                exit();
            } catch (Exception $e) {
                echo "Erro ao cadastrar usuário: " . $e->getMessage();
            }
        }
    }

    // Método para login
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email_usuario'];
            $senha = $_POST['senha_usuario'];

            $usuario = Usuario::login($this->db, $email, $senha);

            if ($usuario) {
                session_start();
                $_SESSION['usuario'] = $usuario;
                header('Location: ../View/dashboard_usuario.php');
                exit();
            } else {
                echo "Credenciais inválidas.";
            }
        }
    }

    // Função para listar os equipamentos alugados pelo usuário
    public function listarEquipamentosAlugados() {
        session_start();
        if (isset($_SESSION['usuario'])) {
            $idUsuario = $_SESSION['usuario']['id_usuario'];
            return Usuario::listarEquipamentosAlugados($this->db, $idUsuario);
        }
        return [];
    }

    // Método para solicitar aluguel de equipamentos
    public function solicitarAluguel() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_usuario = $_POST['id_USUARIO_COMUM'];
            $equipamentos = $_POST['idequipamento']; // Array de IDs dos equipamentos
            $obs = $_POST['obs_aluguel'];
            $data_saida = $_POST['data_saida'];
            $data_devolucao = $_POST['data_devolucao'];
    
            try {
                // Para cada equipamento selecionado, cria uma nova solicitação de aluguel
                foreach ($equipamentos as $idequipamento) {
                    // Instanciando o aluguel
                    $aluguel = new Aluguel($id_usuario, $idequipamento, $obs, $data_saida, $data_devolucao);
                    $aluguel->solicitarAluguel($this->db);
                }
    
                // Redireciona ou exibe uma mensagem de sucesso
                header('Location: ../View/dashboard_usuario.php'); // Redirecionar para a página de dashboard do usuário
                exit();
            } catch (Exception $e) {
                echo "Erro ao solicitar aluguel: " . $e->getMessage();
            }
        }
    }

    // Método para excluir um usuário com mensagens de depuração
    public function excluir($id) {
        try {
            if (empty($id)) {
                echo "ID do usuário está vazio.";
                return;
            }

            echo "Tentando excluir o usuário com ID: " . htmlspecialchars($id) . "<br>";

            $resultado = Usuario::excluir($this->db, $id);

            if ($resultado) {
                echo "Usuário excluído com sucesso.<br>";
            } else {
                echo "Falha ao excluir o usuário. Verifique se o ID existe.<br>";
            }
        } catch (Exception $e) {
            echo "Erro ao excluir usuário: " . $e->getMessage();
        }
    }

    // Método para listar todos os usuários
    public function listar() {
        return Usuario::listar($this->db);
    }
    public function listarAlugueisUsuario() {
        
        // Obtém o ID do usuário logado
        $id_usuario = $_SESSION['usuario']['id_USUARIO_COMUM'];

        // Busca os aluguéis do usuário
        $alugueis = Aluguel::listarAlugueisPorUsuario($this->db, $id_usuario);

        return $alugueis;
    }
}


?>
