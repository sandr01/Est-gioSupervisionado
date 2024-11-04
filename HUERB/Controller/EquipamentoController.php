<?php

require_once "../Excecoes/AutenticarException.php";
require_once "../Conexao/Conexao.php";
require_once "../Model/Equipamento.php";

class EquipamentoController {
    private $db;

    public function __construct() {
        $this->db = Conexao::getConexao(); // Ajuste conforme seu arquivo de conexão
    }

    // Função para cadastrar um novo equipamento
    public function cadastrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $equipamento = new Equipamento(
                $_POST['nome'],
                $_POST['tipo'],
                $_POST['status'],
                $_POST['patrimonio'],
                $_POST['obs'],
                $_POST['id_adm'],
                $_POST['data_entrada'],
                $_POST['quantidade'] // Adicionando o campo quantidade
            );

            try {
                // Salvar equipamento no banco de dados
                $equipamento->cadastrar($this->db);

                // Redireciona para o painel do administrador
                // header('Location: ../View/ListaEquipamento.php');
                echo "<script>alert('Equipamento cadastrado com sucesso!'); window.location.href = '../View/ListaEquipamento.php'; </script>";
                exit();
            } catch (Exception $e) {
                echo "Erro ao cadastrar equipamento: " . $e->getMessage();
            }
        }
    }

    // Função para listar equipamentos
    public function listar() {
        return Equipamento::listarEquipamentos($this->db);
    }

    // Função para remover equipamento
    public function remover($id) {
        try {
            Equipamento::remover($this->db, $id);
            header('Location: ../View/adm.php'); // Redireciona após remoção
            exit();
        } catch (Exception $e) {
            echo "Erro ao remover equipamento: " . $e->getMessage();
        }
    }

    // Função para atualizar equipamento
    public function atualizar($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $equipamento = Equipamento::buscarPorId($this->db, $id);
            if ($equipamento) {
                $equipamento->setNome($_POST['nome']);
                $equipamento->setTipo($_POST['tipo']);
                $equipamento->setStatus($_POST['status']);
                $equipamento->setPatrimonio($_POST['patrimonio']);
                $equipamento->setObs($_POST['obs']);
                $equipamento->setIdAdmAlteracao($_POST['id_adm']);
                $equipamento->setDataEntrada($_POST['data_entrada']);

                try {
                    $equipamento->atualizar($this->db);
                    header('Location: ../View/adm.php'); // Redireciona após atualização
                    exit();
                } catch (Exception $e) {
                    echo "Erro ao atualizar equipamento: " . $e->getMessage();
                }
            }
        }
    }
    
    public function listarEquipamentosAprovados() {
        return Aluguel::listarEquipamentosAprovados($this->db);
    }

    // Método para reduzir a quantidade do equipamento
    public function reduzirQuantidade($idEquipamento, $quantidadeRequisitada) {
        try {
            $equipamento = Equipamento::buscarPorId($this->db, $idEquipamento);
            
            if ($equipamento) {
                $quantidadeAtual = $equipamento->getQuantidade();

                // Verifica se a quantidade atual é suficiente
                if ($quantidadeAtual >= $quantidadeRequisitada) {
                    $novaQuantidade = $quantidadeAtual - $quantidadeRequisitada;

                    // Atualiza a quantidade no banco de dados
                    $equipamento->setQuantidade($novaQuantidade);
                    $equipamento->atualizar($this->db);

                    header('Location: ../View/adm.php?mensagem=Quantidade atualizada com sucesso!');
                    exit();
                } else {
                    throw new Exception("Quantidade solicitada excede a quantidade disponível.");
                }
            } else {
                throw new Exception("Equipamento não encontrado.");
            }
        } catch (Exception $e) {
            echo "Erro ao reduzir quantidade: " . $e->getMessage();
        }
    }

    // Método para aumentar a quantidade do equipamento
public function devolverEquipamento($idEquipamento, $quantidadeDevolvida) {
    try {
        $equipamento = Equipamento::buscarPorId($this->db, $idEquipamento);
        
        if ($equipamento) {
            $quantidadeAtual = $equipamento->getQuantidade();
            $novaQuantidade = $quantidadeAtual + $quantidadeDevolvida; // Aumenta a quantidade

            // Atualiza a quantidade no banco de dados
            $equipamento->setQuantidade($novaQuantidade);
            $equipamento->atualizar($this->db);

            header('Location: ../View/adm.php?mensagem=Devolução realizada com sucesso!');
            exit();
        } else {
            throw new Exception("Equipamento não encontrado.");
        }
    } catch (Exception $e) {
        echo "Erro ao devolver equipamento: " . $e->getMessage();
    }
}


    // Atualiza a quantidade chamando o método reduzirQuantidade
    public function atualizarQuantidade($idEquipamento, $quantidadeRequisitada) {
        $this->reduzirQuantidade($idEquipamento, $quantidadeRequisitada);
    }
}

// Lógica para determinar a ação com base no parâmetro 'acao' na URL
if (isset($_GET['acao'])) {
    $controller = new EquipamentoController();
    $acao = $_GET['acao'];

    switch ($acao) {
        case 'cadastrar':
            $controller->cadastrar();
            break;

        case 'listar':
            $controller->listar();
            break;

        case 'remover':
            if (isset($_GET['id'])) {
                $controller->remover($_GET['id']);
            } else {
                echo "ID do equipamento não fornecido para remoção.";
            }
            break;

        case 'atualizar':
            if (isset($_GET['id'])) {
                $controller->atualizar($_GET['id']);
            } else {
                echo "ID do equipamento não fornecido para atualização.";
            }
            break;

        case 'atualizarQuantidade':
            if (isset($_GET['idEquipamento']) && isset($_GET['quantidade'])) {
                $controller->atualizarQuantidade($_GET['idEquipamento'], $_GET['quantidade']);
            } else {
                echo "ID do equipamento ou quantidade não fornecidos.";
            }
            break;

        default:
            echo "Ação não reconhecida.";
            break;
    }
}
?>
