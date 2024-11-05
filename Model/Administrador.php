<?php

class Administrador {
    private $id;
    private $nome_administrador;
    private $email_administrador;
    private $cpf_administrador;
    private $senha_administrador;
    private $data_nasc_administrador;
    private $contato_administrador;
    private $cargo_administrador;
    private $setor_administrador;

    public function __construct($nome, $email, $cpf, $senha, $data_nasc, $contato, $cargo, $setor) {
        $this->nome_administrador = $nome;
        $this->setEmail($email);
        $this->cpf_administrador = $cpf;
        $this->setSenha($senha); // Armazena a senha já com hash
        $this->data_nasc_administrador = $data_nasc;
        $this->contato_administrador = $contato;
        $this->cargo_administrador = $cargo;
        $this->setor_administrador = $setor;
    }

    // Métodos GET e SET

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome_administrador;
    }

    public function setNome($nome) {
        $this->nome_administrador = $nome;
    }

    public function getEmail() {
        return $this->email_administrador;
    }

    public function setEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email_administrador = $email;
        } else {
            throw new Exception("Email inválido.");
        }
    }

    public function getCpf() {
        return $this->cpf_administrador;
    }

    public function setCpf($cpf) {
        $this->cpf_administrador = $cpf;
    }

    public function getSenha() {
        return $this->senha_administrador;
    }

    public function setSenha($senha) {
        $this->senha_administrador = password_hash($senha, PASSWORD_BCRYPT);
    }

    public function getDataNasc() {
        return $this->data_nasc_administrador;
    }

    public function setDataNasc($data_nasc) {
        $this->data_nasc_administrador = $data_nasc;
    }

    public function getContato() {
        return $this->contato_administrador;
    }

    public function setContato($contato) {
        $this->contato_administrador = $contato;
    }

    public function getCargo() {
        return $this->cargo_administrador;
    }

    public function setCargo($cargo) {
        $this->cargo_administrador = $cargo;
    }

    public function getSetor() {
        return $this->setor_administrador;
    }

    public function setSetor($setor) {
        $this->setor_administrador = $setor;
    }

    // Método para salvar administrador
    public function cadastrar($conn) {
        $sql = "INSERT INTO usuario_administrador (nome_administrador, email_administrador, cpf_administrador, senha_administrador, data_nasc_administrador, contato_administrador, cargo_administrador, setor_administrador)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $this->nome_administrador);
        $stmt->bindParam(2, $this->email_administrador);
        $stmt->bindParam(3, $this->cpf_administrador);
        $stmt->bindParam(4, $this->senha_administrador);
        $stmt->bindParam(5, $this->data_nasc_administrador);
        $stmt->bindParam(6, $this->contato_administrador);
        $stmt->bindParam(7, $this->cargo_administrador);
        $stmt->bindParam(8, $this->setor_administrador);
        $stmt->execute();
        $this->id = $conn->lastInsertId();
    }

    // Função para login de administrador
    public static function login($conn, $email, $senha) {
        $sql = "SELECT * FROM usuario_administrador WHERE email_administrador = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $email);
        $stmt->execute();
        $administrador = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($administrador && password_verify($senha, $administrador['senha_administrador'])) {
            return $administrador;   
        }
        return false;
    }

    // Função para listar administradores
    public static function listarAdministradores($conn) {
        $sql = "SELECT * FROM usuario_administrador";
        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Administrador');
    }
}
?>
