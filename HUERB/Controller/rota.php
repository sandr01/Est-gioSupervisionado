<?php
session_start();
require_once "../Model/Usuario.php";
require_once "../Model/Equipamento.php";
require_once "../Model/Administrador.php";
require_once "AdministradorController.php";
require_once "EquipamentoController.php"; 
require_once "UsuarioController.php"; 
require_once "AluguelController.php"; 

$acao = isset($_GET['acao']) ? $_GET['acao'] : '';

$administradorController = new AdministradorController();
$equipamentoController = new EquipamentoController(); 
$usuarioController = new UsuarioController();
$aluguelController = new AluguelController(); 

switch ($acao) {
    // Rotas para o Administrador
    case "cadastro":
        header('Location: ../View/cad_adm.php');
        break;

    case "cadastrar":
        $administradorController->cadastrar();
        break;

    case "login":
        header('Location: ../View/login_adm.php');
        break;

    case "logar":
        $administradorController->login();
        break;

    case "listarSolicitacoes":
        $solicitacoesPendentes = $administradorController->listarSolicitacoesPendentes();
        break;

    case "aprovarSolicitacao":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_aluguel = $_POST['idaluguel'];
            $quantidade_solicitada = $_POST['quantidade_solicitada'];
            $status = 'aprovado'; // Defina o status como aprovado
            
            $id_adm_aluguel = $_SESSION['admin']['id_usuario_administrador'];
    
            if (isset($id_adm_aluguel)) {
                // Chama o método atualizarStatus do AluguelController
                $aluguelController->atualizarStatusAluguel($id_aluguel, $status, $id_adm_aluguel, $quantidade_solicitada);
            } else {
                echo "Erro: Administrador não logado.";
            }
        }
        break;

    case "atualizarStatus":
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_aluguel = $_POST['idaluguel'];
            $status = $_POST['status'];
            $quantidade_solicitada = $_POST['quantidade_solicitada'];
            
            $id_adm_aluguel = $_SESSION['admin']['id_usuario_administrador'];
    
            if (isset($id_adm_aluguel)) {
                // Chama o método atualizarStatus do AluguelController, que internamente chama reduzirQuantidade
                $aluguelController->atualizarStatusAluguel($id_aluguel, $status, $id_adm_aluguel, $quantidade_solicitada);
            } else {
                echo "Erro: Administrador não logado.";
            }
        }
        break;

    // Rotas para Equipamentos
    case "cadEquipamento":
        header('Location: ../View/cadastrar.php');
        break;

    case "salvarEquipamento":
        $equipamentoController->cadastrar();
        break;

    case "listarEquipamentos":
        $equipamentoController->listar();
        break;

    // Rotas para Usuários
    case "cadUsuario":
        header('Location: ../View/cad_usuario.php');
        break;

    case "cadastrarUsuario":
        $usuarioController->cadastrar();
        break;

    case "loginUsuario":
        header('Location: ../View/login_usuario.php');
        break;

    case "logarUsuario":
        $usuarioController->login();
        break;

    // Rotas para Aluguel de Equipamentos
    case "solicitarAluguel":
        $aluguelController->solicitarAluguel();
        break;

    case "listarAlugados":
        $equipamentosAlugados = $aluguelController->listarAlugados($_SESSION['usuario']['idusuario']);
        break;
    
    case "devolverEquipamento":
            // Verifica se a ação solicitada é devolverEquipamento
        if ($_GET['acao'] == 'devolverEquipamento') {
            $idEquipamento = $_POST['idequipamento'];
            $quantidadeSolicitada = $_POST['quantidade_solicitada'];

            // Chamando o método para devolução
            $aluguelController->devolverEquipamento($idEquipamento, $quantidadeSolicitada);
            
            // Redireciona de volta ao painel do administrador
            header('Location: ../View/adm.php');
            exit();
        }
        break;
        

    default:
        echo "Ação não reconhecida.";
        break;
}
?>
