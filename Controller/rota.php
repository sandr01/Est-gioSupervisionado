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
            $id_aluguel = $_POST['idaluguel'] ?? null;
            $quantidade_solicitada = $_POST['quantidade_solicitada'] ?? 0;
            $status = 'aprovado';
            $id_adm_aluguel = $_SESSION['admin']['id_usuario_administrador'] ?? null;

            if ($id_adm_aluguel && $id_aluguel) {
                // Chama o método atualizarStatus do AluguelController
                $aluguelController->atualizarStatusAluguel($id_aluguel, $status, $id_adm_aluguel, $quantidade_solicitada);
            } else {
                echo "Erro: Administrador não logado ou ID de aluguel não encontrado.";
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
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                $idAluguel = $_POST['idaluguel'] ?? null; // Corrigido para 'idaluguel'
                $idEquipamento = $_POST['id_equip_aluguel'] ?? null;
                $quantidadeDevolvida = $_POST['quantidade_devolvida'] ?? 0;
        
                if ($idAluguel && $idEquipamento) {
                    // Chamando o método de devolução no AluguelController
                    $aluguelController->devolverEquipamento($idAluguel, $idEquipamento, $quantidadeDevolvida);
                } else {
                    echo "Erro: ID de aluguel ou ID de equipamento não encontrado.";
                }
            }
            break;
        
            case "logout":
                // Destrói todas as variáveis de sessão
                $_SESSION = array();
        
                // Se for necessário destruir a sessão completamente
                if (ini_get("session.use_cookies")) {
                    $params = session_get_cookie_params();
                    setcookie(session_name(), '', time() - 42000,
                        $params["path"], $params["domain"],
                        $params["secure"], $params["httponly"]
                    );
                }
                session_destroy();
        
                // Redireciona para a página de login
                header('Location: ../View/login_adm.php?mensagem=Logout realizado com sucesso!');
                exit();
                break;

                case "logout_usuario":
                    // Destrói todas as variáveis de sessão
                    $_SESSION = array();
            
                    // Se for necessário destruir a sessão completamente
                    if (ini_get("session.use_cookies")) {
                        $params = session_get_cookie_params();
                        setcookie(session_name(), '', time() - 42000,
                            $params["path"], $params["domain"],
                            $params["secure"], $params["httponly"]
                        );
                    }
                    session_destroy();
            
                    // Redireciona para a página de login
                    header('Location: ../View/login_usuario.php?mensagem=Logout realizado com sucesso!');
                    exit();
                    break;

                case "removerEquipamento":
                     $id = $_GET['id'] ?? null;
                      if ($id) {
                         $equipamentoController->remover($id);
                      } else {
                         echo "Erro: ID do equipamento não encontrado.";
                      }
                     break;

    default:
        echo "Ação não reconhecida.";
        break;
}
?>