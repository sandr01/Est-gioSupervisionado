<?php

require_once "../Excecoes/AutenticarException.php";
require_once "../Conexao/Conexao.php";
require_once "../Model/Administrador.php";

class AdministradorController {
    private $db;

    public function __construct() {
        $this->db = Conexao::getConexao(); // Ajuste conforme seu arquivo de conexão
    }

    // Função para cadastrar um novo administrador
    public function cadastrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $administrador = new Administrador(
                $_POST['nome_administrador'],
                $_POST['email_administrador'],
                $_POST['cpf_administrador'],
                $_POST['senha_administrador'],
                $_POST['data_nasc_administrador'],
                $_POST['contato_administrador'],
                $_POST['cargo_administrador'],
                $_POST['setor_administrador']
            );
            
            try {
                // Salvar administrador no banco de dados
                $administrador->cadastrar($this->db);

                // Redireciona para a tela de login
                header('Location: ../View/login_adm.php');
                exit();
            } catch (Exception $e) {
                echo "Erro ao cadastrar administrador: " . $e->getMessage();
            }
        }
    }

    // Função para login
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email_administrador'];
            $senha = $_POST['senha_administrador'];

            $admin = Administrador::login($this->db, $email, $senha);

            if ($admin) {
                // Iniciar sessão e armazenar dados do administrador logado
                session_start();
                $_SESSION['admin'] = $admin;
                header('Location: ../View/adm.php'); // Redireciona para o painel do administrador
                exit();
            } else {
                echo "Credenciais inválidas.";
            }
        }
    }
    public function listarSolicitacoesPendentes() {
        session_start(); // Inicia a sessão se não estiver ativa
    
        // Verifique se o administrador está logado
        if (!isset($_SESSION['admin'])) {
            echo "Administrador não logado.";
            return;
        }
    
        // Pega as solicitações pendentes de aluguel
        $solicitacoesPendentes = Aluguel::listarSolicitacoesPendentes($this->db);
        
        // Exibe as solicitações (Ajustar para uma view HTML conforme necessário)
        foreach ($solicitacoesPendentes as $solicitacao) {
            echo "Equipamento: " . htmlspecialchars($solicitacao['id_equipamento']) . "<br>";
            echo "Usuário: " . htmlspecialchars($solicitacao['id_usuario_aluguel']) . "<br>";
            echo "Data de Saída: " . htmlspecialchars($solicitacao['aluguel_data_saida']) . "<br>";
            echo "Data de Devolução: " . htmlspecialchars($solicitacao['aluguel_data_devolucao']) . "<br>";
            echo "<form method='post' action='rota_admin.php?acao=atualizarStatus'>";
            echo "<input type='hidden' name='id_aluguel' value='" . htmlspecialchars($solicitacao['id_aluguel']) . "'>";
            echo "<select name='status'>";
            echo "<option value='aprovado'>Aprovar</option>";
            echo "<option value='recusado'>Recusar</option>";
            echo "</select>";
            echo "<button type='submit'>Enviar</button>";
            echo "</form><br>";
        }
    }
    
   
}
?>
