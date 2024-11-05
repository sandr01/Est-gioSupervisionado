<?php
require_once "../Conexao/Conexao.php";

class Equipamento {
    private $id;
    private $nome_equipamento;
    private $tipo_equipamento;
    private $status_equipamento;
    private $patrimonio_equipamento;
    private $obs_equipamento;
    private $id_adm_alteracao;
    private $data_entrada;
    private $quantidade;

    public function __construct($nome, $tipo, $status, $patrimonio, $obs, $id_adm, $data_entrada, $quantidade, $id = null) {
        $this->nome_equipamento = $nome;
        $this->tipo_equipamento = $tipo;
        $this->status_equipamento = $status;
        $this->patrimonio_equipamento = $patrimonio;
        $this->obs_equipamento = $obs;
        $this->id_adm_alteracao = $id_adm;
        $this->data_entrada = $data_entrada;
        $this->quantidade = $quantidade;
        $this->id = $id; // Inicializando o ID, caso seja passado
    }

    // Métodos GET e SET
    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome_equipamento;
    }

    public function setNome($nome) {
        $this->nome_equipamento = $nome;
    }

    public function getTipo() {
        return $this->tipo_equipamento;
    }

    public function setTipo($tipo) {
        $this->tipo_equipamento = $tipo;
    }

    public function getStatus() {
        return $this->status_equipamento;
    }

    public function setStatus($status) {
        $this->status_equipamento = $status;
    }

    public function getPatrimonio() {
        return $this->patrimonio_equipamento;
    }

    public function setPatrimonio($patrimonio) {
        $this->patrimonio_equipamento = $patrimonio;
    }

    public function getObs() {
        return $this->obs_equipamento;
    }

    public function setObs($obs) {
        $this->obs_equipamento = $obs;
    }

    public function getIdAdmAlteracao() {
        return $this->id_adm_alteracao;
    }

    public function setIdAdmAlteracao($id_adm) {
        $this->id_adm_alteracao = $id_adm;
    }

    public function getDataEntrada() {
        return $this->data_entrada;
    }

    public function setDataEntrada($data_entrada) {
        $this->data_entrada = $data_entrada;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }

    public function setQuantidade($novaQuantidade) {
        $this->quantidade = $novaQuantidade;
    }

    // Método para cadastrar equipamento
    public function cadastrar($conn) {
        $sql = "INSERT INTO equipamentos (nome_equipamento, tipo_equipamento, status_equipamento, patrimonio_equipamento, obs_equipamento, id_adm_alteracao, data_entrada, quantidade)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $this->nome_equipamento);
        $stmt->bindParam(2, $this->tipo_equipamento);
        $stmt->bindParam(3, $this->status_equipamento);
        $stmt->bindParam(4, $this->patrimonio_equipamento);
        $stmt->bindParam(5, $this->obs_equipamento);
        $stmt->bindParam(6, $this->id_adm_alteracao);
        $stmt->bindParam(7, $this->data_entrada);
        $stmt->bindParam(8, $this->quantidade);

        $stmt->execute();
        $this->id = $conn->lastInsertId(); // Atribuindo o ID gerado
    }

    // Método para listar equipamentos
    public static function listarEquipamentos($conn) {
        $sql = "SELECT * FROM equipamentos"; 
        $stmt = $conn->query($sql);

        $equipamentos = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $equipamento = new Equipamento(
                $row['nome_equipamento'], 
                $row['tipo_equipamento'],
                $row['status_equipamento'],
                $row['patrimonio_equipamento'],
                $row['obs_equipamento'],
                $row['id_adm_alteracao'],
                $row['data_entrada'],
                $row['quantidade'],
                $row['idequipamento']
            );
            $equipamentos[] = $equipamento;
        }

        return $equipamentos;
    }

    // Método para buscar equipamento por ID
    public static function buscarPorId($conn, $id) {
        $sql = "SELECT * FROM equipamentos WHERE idequipamento = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($result) {
            return new Equipamento(
                $result['nome_equipamento'],
                $result['tipo_equipamento'],
                $result['status_equipamento'],
                $result['patrimonio_equipamento'],
                $result['obs_equipamento'],
                $result['id_adm_alteracao'],
                $result['data_entrada'],
                $result['quantidade'],
                $result['idequipamento']
            );
        }
        return null;
    }

    // Método para atualizar equipamento
    public function atualizar($conn) {
        $sql = "UPDATE equipamentos SET 
                    nome_equipamento = ?, 
                    tipo_equipamento = ?, 
                    status_equipamento = ?, 
                    patrimonio_equipamento = ?, 
                    obs_equipamento = ?, 
                    id_adm_alteracao = ?, 
                    data_entrada = ?, 
                    quantidade = ? 
                WHERE idequipamento = ?";
        $stmt = $conn->prepare($sql);

        var_dump($this->nome_equipamento, $this->tipo_equipamento, $this->status_equipamento, 
             $this->patrimonio_equipamento, $this->obs_equipamento, $this->id_adm_alteracao, 
             $this->data_entrada, $this->quantidade, $this->id);

        $stmt->bindParam(1, $this->nome_equipamento);
        $stmt->bindParam(2, $this->tipo_equipamento);
        $stmt->bindParam(3, $this->status_equipamento);
        $stmt->bindParam(4, $this->patrimonio_equipamento);
        $stmt->bindParam(5, $this->obs_equipamento);
        $stmt->bindParam(6, $this->id_adm_alteracao);
        $stmt->bindParam(7, $this->data_entrada);
        $stmt->bindParam(8, $this->quantidade);
        $stmt->bindParam(9, $this->id);
        $stmt->execute();
    }

    // Método para remover equipamento
    public static function remover($conn, $id) {
        $sql = "DELETE FROM equipamentos WHERE idequipamento = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $id);
        $stmt->execute();

        if ($stmt->execute()) {
            echo "Equipamento atualizado com sucesso.";
        } else {
            echo "Erro ao atualizar equipamento.";
        }
    }

    private static function atualizarQuantidadeGeral($conn, $idEquipamento, $quantidade) {
        $stmt = $conn->prepare("UPDATE equipamentos SET quantidade = :quantidade WHERE idequipamento = :idEquipamento");
        $stmt->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);
        $stmt->bindParam(':idEquipamento', $idEquipamento, PDO::PARAM_INT);
        return $stmt->execute();
    }
    
    public static function atualizarQuantidade($conn, $idEquipamento, $novaQuantidade) {
        if ($novaQuantidade < 0) {
            throw new Exception("Quantidade não pode ser negativa.");
        }
        return self::atualizarQuantidadeGeral($conn, $idEquipamento, $novaQuantidade);
    }
    
    public static function adicionarQuantidade($conn, $idEquipamento, $quantidadeParaAdicionar) {
        if ($quantidadeParaAdicionar < 0) {
            throw new Exception("Quantidade a adicionar não pode ser negativa.");
        }
        $quantidadeAtual = self::obterQuantidade($conn, $idEquipamento);
        $novaQuantidade = $quantidadeAtual + $quantidadeParaAdicionar;
        return self::atualizarQuantidadeGeral($conn, $idEquipamento, $novaQuantidade);
    }
    

    // Método para obter a quantidade atual do equipamento
    public static function obterQuantidade($conn, $idEquipamento) {
        $stmt = $conn->prepare("SELECT quantidade FROM equipamentos WHERE idequipamento = :idEquipamento");
        $stmt->bindParam(':idEquipamento', $idEquipamento, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? (int)$result['quantidade'] : 0; // Retorna a quantidade ou 0 se não encontrado
    }

    
}
?>