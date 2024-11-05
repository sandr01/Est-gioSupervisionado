<?php

require_once "../Conexao/Conexao.php";
class Aluguel {
    private $idaluguel;
    private $id_usuario;
    private $id_equipamento;
    private $data_saida;
    private $data_devolucao;
    private $obs;
    private $status; // Novo campo para status (aprovado/recusado)

    private $quantidade;

    public function __construct($id_usuario, $id_equipamento, $data_saida, $data_devolucao, $obs, $quantidade) {
        $this->id_usuario = $id_usuario;
        $this->id_equipamento = $id_equipamento;
        $this->data_saida = $data_saida;
        $this->data_devolucao = $data_devolucao;
        $this->obs = $obs;
        $this->status = 'pendente'; // Definir como pendente inicialmente
        $this->quantidade = $quantidade;
    }

    // Getters e setters
    public function getIdAluguel() {
        return $this->idaluguel;
    }

    public function setIdAluguel($idaluguel) {
        $this->idaluguel = $idaluguel;
    }

    public function getIdUsuario() {
        return $this->id_usuario;
    }

    public function setIdUsuario($id_usuario) {
        $this->id_usuario = $id_usuario;
    }

    public function getIdEquipamento() {
        return $this->id_equipamento;
    }

    public function setIdEquipamento($id_equipamento) {
        $this->id_equipamento = $id_equipamento;
    }

    public function getDataSaida() {
        return $this->data_saida;
    }

    public function setDataSaida($data_saida) {
        $this->data_saida = $data_saida;
    }

    public function getDataDevolucao() {
        return $this->data_devolucao;
    }

    public function setDataDevolucao($data_devolucao) {
        $this->data_devolucao = $data_devolucao;
    }

    public function getObs() {
        return $this->obs;
    }

    public function setObs($obs) {
        $this->obs = $obs;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        $this->status = $status;
    }
    public function getQuantidade_Solicitada() {
        return $this->quantidade;
    }

    public function setQuantidade_Solicitada($quantidade) {
        $this->quantidade = $quantidade;
    }

    // Método para salvar aluguel no banco de dados
    public function salvar($conn) {
        $sql = "INSERT INTO aluguel (
                    id_usuario_aluguel, 
                    id_equip_aluguel, 
                    obs_aluguel, 
                    aluguel_data_saida, 
                    aluguel_data_devolucao,
                    status_aluguel,
                    quantidade_solicitada
                ) VALUES (?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $this->id_usuario);
        $stmt->bindParam(2, $this->id_equipamento);
        $stmt->bindParam(3, $this->obs);
        $stmt->bindParam(4, $this->data_saida);
        $stmt->bindParam(5, $this->data_devolucao);
        $stmt->bindParam(6, $this->status); // O status é "pendente" inicialmente
        $stmt->bindParam(7, $this->quantidade);
        $stmt->execute();
    
        $this->idaluguel = $conn->lastInsertId();
    }

    public function aprovar($conn) {
        // Atualizar o status do aluguel
        $this->atualizarStatus($conn, $this->idaluguel, 'aprovado');
        
        // Atualizar a quantidade do equipamento
        $equipamento = Equipamento::obterQuantidade($conn, $this->id_equipamento);
        $novaQuantidade = $equipamento - $this->quantidade;
        
        if ($novaQuantidade < 0) {
            throw new Exception("Quantidade solicitada maior que a disponível.");
        }
        
        Equipamento::atualizarQuantidade($conn, $this->id_equipamento, $novaQuantidade);
    }

    public static function buscarPorId($conn, $id_aluguel) {
    $sql = "SELECT * FROM aluguel WHERE idaluguel = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $id_aluguel);
    $stmt->execute();

    $aluguel = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($aluguel) {
        return $aluguel;
    } else {
        return null; // Retorna null se o aluguel não for encontrado
    }
}


    // Método para listar todas as solicitações de aluguel
    public static function listarAlugueis($conn) {
        $sql = "SELECT * FROM aluguel";
        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Aluguel');
    }

    // Método para listar apenas as solicitações pendentes
    public static function listarSolicitacoesPendentes($conn) {
        $sql = "SELECT aluguel.*, 
                       usuario_comum.nome_usuario AS nome_usuario, 
                       equipamentos.nome_equipamento AS nome_equipamento 
                FROM aluguel 
                JOIN usuario_comum ON aluguel.id_usuario_aluguel = usuario_comum.id_USUARIO_COMUM 
                JOIN equipamentos ON aluguel.id_equip_aluguel = equipamentos.idequipamento
                WHERE aluguel.status_aluguel = 'pendente'";
        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Método para atualizar o status de uma solicitação de aluguel
    public static function atualizarStatus($conn, $id_aluguel, $novo_status) {
        $sql = "UPDATE aluguel SET status_aluguel = ? WHERE idaluguel = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $novo_status);
        $stmt->bindParam(2, $id_aluguel);
        $stmt->execute();
    }

    // Método para listar todos os alugueis de um usuário específico
    public static function listarAlugueisPorUsuario($conn, $id_usuario) {
        $sql = "SELECT aluguel.*, equipamentos.nome_equipamento AS nome_equipamento 
                FROM aluguel 
                JOIN equipamentos ON aluguel.id_equip_aluguel = equipamentos.idequipamento
                WHERE aluguel.id_usuario_aluguel = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $id_usuario);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    // Novo método: listar equipamentos emprestados (com detalhes do solicitante e equipamento)
    public static function listarEquipamentosEmprestados($conn) {
        $sql = "
            SELECT aluguel.*, 
                   aluguel.aluguel_data_saida AS aluguel_data_saida,
                   usuario_comum.nome_usuario AS nome_usuario
            FROM aluguel 
            JOIN usuario_comum ON aluguel.id_usuario_aluguel = usuario_comum.id_USUARIO_COMUM
            WHERE aluguel.status_aluguel = 'aprovado'";
        
        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function listarEquipamentosAprovados($conn) {
        $sql = "
        SELECT 
            aluguel.idaluguel,
            aluguel.id_equip_aluguel AS idequipamento,
            equipamentos.nome_equipamento AS nome_equipamento,
            aluguel.quantidade_solicitada AS quantidade,
            aluguel.obs_aluguel,
            aluguel.aluguel_data_saida,
            aluguel.aluguel_data_devolucao,
            aluguel.status_aluguel,
            usuario_comum.nome_usuario AS nome_usuario
        FROM 
            aluguel
        JOIN 
            equipamentos ON aluguel.id_equip_aluguel = equipamentos.idequipamento
        JOIN 
            usuario_comum ON aluguel.id_usuario_aluguel = usuario_comum.id_USUARIO_COMUM
        WHERE 
            aluguel.status_aluguel = 'aprovado';
    ";
    
        
        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    
}