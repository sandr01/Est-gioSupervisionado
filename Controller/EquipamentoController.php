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
                $_POST['quantidade']
            );

            try {
                // Salvar equipamento no banco de dados
                $equipamento->cadastrar($this->db);

                // Redireciona para o painel do administrador
                header('Location: ../View/adm.php?mensagem=Equipamento cadastrado com sucesso!');
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
                    header('Location: ../View/adm.php?mensagem=Equipamento atualizado com sucesso!');
                    exit();
                } catch (Exception $e) {
                    echo "Erro ao atualizar equipamento: " . $e->getMessage();
                }
            } else {
                echo "Erro: Equipamento não encontrado.";
            }
        }
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

   // Método para atualizar a quantidade do equipamento
public function atualizarQuantidade($idEquipamento, $quantidade, $acao) {
    if ($acao === 'aumentar') {
        // Aumentar a quantidade
        $equipamento = Equipamento::buscarPorId($this->db, $idEquipamento);
        if ($equipamento) {
            $novaQuantidade = $equipamento->getQuantidade() + $quantidade;
            $equipamento->setQuantidade($novaQuantidade);
            $equipamento->atualizar($this->db);
        } else {
            throw new Exception("Equipamento não encontrado para aumentar quantidade.");
        }
    } elseif ($acao === 'diminuir') {
        // Diminuir a quantidade
        $this->reduzirQuantidade($idEquipamento, $quantidade);
    } else {
        throw new Exception("Ação inválida para atualizar quantidade.");
    }
}


}



?>
