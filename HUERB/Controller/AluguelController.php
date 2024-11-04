<?php
require_once "../Model/Aluguel.php";
require_once "../Model/Equipamento.php"; // Inclua o modelo de Equipamento
require_once "../Conexao/Conexao.php";

class AluguelController {
    private $db;

    public function __construct() {
        $this->db = Conexao::getConexao();
    }

    public function solicitarAluguel() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Verifica se o usuário está logado
        if (!isset($_SESSION['usuario'])) {
            echo "Usuário não logado.";
            return;
        }

        // Obtém o ID do usuário logado
        $id_usuario = $_SESSION['usuario']['id_USUARIO_COMUM'];

        // Verifica se os campos obrigatórios foram enviados
        if (!isset($_POST['id_equip_aluguel']) || !isset($_POST['aluguel_data_devolucao']) || !isset($_POST['quantidade'])) {
            echo "Dados incompletos.";
            return;
        }

        // Atribui os valores dos campos do formulário
        $id_equipamento = $_POST['id_equip_aluguel'];
        $data_devolucao = $_POST['aluguel_data_devolucao'];
        $obs = isset($_POST['obs_aluguel']) ? $_POST['obs_aluguel'] : '';
        $quantidade = $_POST['quantidade'];

        // Cria um novo objeto Aluguel e define os valores
        $aluguel = new Aluguel(
            $id_usuario,
            $id_equipamento,
            date('Y-m-d'), // Data de saída
            $data_devolucao,
            $obs,
            $quantidade
        );

        // Salva a solicitação de aluguel no banco de dados
        try {
            $aluguel->salvar($this->db);
            header("Location: ../View/dashboard_usuario.php"); // Atualize o caminho conforme necessário
            exit();
        } catch (Exception $e) {
            echo "Erro ao solicitar aluguel: " . $e->getMessage();
        }
    }

    public function listarSolicitacoesPendentes() {
        return Aluguel::listarSolicitacoesPendentes($this->db);
    }

    public function atualizarStatusAluguel() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        if (!isset($_SESSION['admin'])) {
            echo "Administrador não logado.";
            return;
        }
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_aluguel = $_POST['idaluguel'];
            $status = $_POST['status'];
    
            try {
                $aluguel = Aluguel::buscarPorId($this->db, $id_aluguel);
                if (!$aluguel) {
                    echo "Aluguel não encontrado.";
                    return;
                }
    
                $id_equip_aluguel = $aluguel['id_equip_aluguel'];
                $quantidade_solicitada = $aluguel['quantidade_solicitada'];
    
                $equipamento = Equipamento::buscarPorId($this->db, $id_equip_aluguel);
                if (!$equipamento) {
                    echo "Equipamento não encontrado.";
                    return;
                }
    
                if ($status === 'aprovado' && $equipamento->getQuantidade() >= $quantidade_solicitada) {
                    $equipamento->setQuantidade($equipamento->getQuantidade() - $quantidade_solicitada);
                    $equipamento->atualizar($this->db);
                } elseif ($status === 'aprovado') {
                    echo "Quantidade insuficiente.";
                    return;
                }
    
                Aluguel::atualizarStatus($this->db, $id_aluguel, $status);
                header('Location: ../View/adm.php');
                exit();
            } catch (Exception $e) {
                echo "Erro ao atualizar o status: " . $e->getMessage();
            }
        }
    }
    
    
    
    public function atualizarStatus() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_aluguel = $_POST['idaluguel'] ?? null; // Usar null coalescing para evitar notices
            $status = $_POST['status'] ?? null; // Usar null coalescing
            $quantidadeSolicitada = $_POST['quantidade_solicitada'] ?? null; // Usar null coalescing
    
            if ($id_aluguel === null || $status === null || $quantidadeSolicitada === null) {
                echo "Dados incompletos.";
                return;
            }
    
            try {
                // Atualiza o status da solicitação
                Aluguel::atualizarStatus($this->db, $id_aluguel, $status);
    
                // Se o status for aprovado, atualize a quantidade do equipamento
                if ($status === 'aprovado') {
                    // Obtenha o ID do equipamento relacionado à solicitação
                    $solicitacao = $this->buscarSolicitacaoPorId($id_aluguel);
                    if ($solicitacao) {
                        $equipamentoId = $solicitacao['id_equip_aluguel'];
                        // Subtraia a quantidade solicitada
                        $this->atualizarQuantidadeEquipamento($equipamentoId, $quantidadeSolicitada);
                    } else {
                        echo "Erro: Solicitação não encontrada.";
                    }
                }
    
                header('Location: ../View/adm.php');
                exit();
            } catch (Exception $e) {
                echo "Erro ao atualizar o status: " . $e->getMessage();
            }
        }
    }
    
    
    private function buscarSolicitacaoPorId($id_aluguel) {
        $sql = "SELECT * FROM aluguel WHERE idaluguel = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(1, $id_aluguel);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private function atualizarQuantidadeEquipamento($equipamentoId, $quantidadeSolicitada) {
        // Busca o equipamento atual
        $equipamento = Equipamento::buscarPorId($this->db, $equipamentoId);
        if ($equipamento) {
            $novaQuantidade = $equipamento->getQuantidade() - $quantidadeSolicitada;
        
            // Verifique se a nova quantidade não é negativa
            if ($novaQuantidade >= 0) {
                // Atualiza a quantidade do equipamento
                $equipamento->setQuantidade($novaQuantidade);
                $equipamento = Equipamento::atualizar($this->db);
                echo "Quantidade do equipamento atualizada com sucesso!";
            } else {
                echo "Erro: Quantidade insuficiente do equipamento.";
            }
        } else {
            echo "Erro: Equipamento não encontrado.";
        }
    }

    public function devolverEquipamento($idAluguel) {
        // Buscar a solicitação de aluguel
        $aluguel = Aluguel::buscarPorId($this->db, $idAluguel);
        
        if ($aluguel) {
            $idEquipamento = $aluguel['id_equip_aluguel'];
            $quantidadeDevolvida = $aluguel['quantidade_devolvida']; // A quantidade que está sendo devolvida
    
            // Adicionar a quantidade de volta ao equipamento
            if (Equipamento::adicionarQuantidade($this->db, $idEquipamento, $quantidadeDevolvida)) {
                // Atualizar status do aluguel para 'devolvido'
                Aluguel::atualizarStatus($this->db, $idAluguel, 'devolvido');
            }
        }
    }
    
    

    public function listarEquipamentosAprovados() {
        return Aluguel::listarEquipamentosAprovados($this->db);
    }
}
