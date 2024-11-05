<?php
require_once "../Model/Aluguel.php";
require_once "../Model/Equipamento.php"; // Inclua o modelo de Equipamento
require_once "../Conexao/Conexao.php";

class AluguelController {
    private $db;

    public function __construct() {
        $this->db = Conexao::getConexao();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function solicitarAluguel() {
        // Verifica se o usuário está logado
        if (!isset($_SESSION['usuario'])) {
            echo "Usuário não logado.";
            return;
        }

        // Obtém o ID do usuário logado
        $id_usuario = $_SESSION['usuario']['id_USUARIO_COMUM'];

        // Verifica se os campos obrigatórios foram enviados
        if (!isset($_POST['id_equip_aluguel'], $_POST['aluguel_data_devolucao'], $_POST['quantidade'])) {
            echo "Dados incompletos.";
            return;
        }

        // Atribui os valores dos campos do formulário
        $id_equipamento = $_POST['id_equip_aluguel'];
        $data_devolucao = $_POST['aluguel_data_devolucao'];
        $obs = $_POST['obs_aluguel'] ?? '';
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
            header("Location: ../View/dashboard_usuario.php");
            exit();
        } catch (Exception $e) {
            echo "Erro ao solicitar aluguel: " . $e->getMessage();
        }
    }

    public function listarSolicitacoesPendentes() {
        return Aluguel::listarSolicitacoesPendentes($this->db);
    }

    public function atualizarStatusAluguel() {
        // Verifica se o administrador está logado
        if (!isset($_SESSION['admin'])) {
            echo "Administrador não logado.";
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_aluguel = $_POST['idaluguel'];
            $status = $_POST['status'];
            $quantidadeSolicitada = $_POST['quantidade_solicitada'] ?? null;

            // Atualiza o status
            $this->atualizarStatus($id_aluguel, $status, $quantidadeSolicitada);
        }
    }

    private function atualizarStatus($id_aluguel, $status, $quantidadeSolicitada) {
        try {
            // Atualiza o status da solicitação
            Aluguel::atualizarStatus($this->db, $id_aluguel, $status);

            // Se o status for aprovado, atualize a quantidade do equipamento
            if ($status === 'aprovado') {
                $solicitacao = $this->buscarSolicitacaoPorId($id_aluguel);
                if ($solicitacao) {
                    $equipamentoId = $solicitacao['id_equip_aluguel'];
                    $this->atualizarQuantidadeEquipamento($equipamentoId, $quantidadeSolicitada);
                } else {
                    throw new Exception("Solicitação não encontrada.");
                }
            }

            header('Location: ../View/adm.php');
            exit();
        } catch (Exception $e) {
            echo "Erro ao atualizar o status: " . $e->getMessage();
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
                $equipamento->atualizar($this->db);
                echo "Quantidade do equipamento atualizada com sucesso!";
            } else {
                echo "Erro: Quantidade insuficiente do equipamento.";
            }
        } else {
            echo "Erro: Equipamento não encontrado.";
        }
    }

    public function devolverEquipamento($idAluguel, $idEquipamento, $quantidadeDevolvida) {
        // Busca a solicitação de aluguel
        $aluguel = Aluguel::buscarPorId($this->db, $idAluguel);
        
        if ($aluguel) {
            $idEquipamento = $aluguel['id_equip_aluguel'];

            try {
                // Atualiza a quantidade do equipamento, aumentando-a
                $equipamentoController = new EquipamentoController();
                $equipamentoController->atualizarQuantidade($idEquipamento, $quantidadeDevolvida, 'aumentar'); // Aumenta a quantidade

                // Atualiza o status do aluguel para 'devolvido'
                Aluguel::atualizarStatus($this->db, $idAluguel, 'devolvido');

                header('Location: ../View/adm.php?mensagem=Devolução realizada e quantidade atualizada com sucesso!');
                exit();
            } catch (Exception $e) {
                echo "Erro ao processar a devolução: " . $e->getMessage();
            }
        } else {
            echo "Erro: Aluguel não encontrado.";
        }
    }

    public function listarEquipamentosAprovados() {
        return Aluguel::listarEquipamentosAprovados($this->db);
    }
}
