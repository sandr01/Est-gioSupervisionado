<?php

class Usuario {
    private $id;
    private $nome_usuario;
    private $email_usuario;
    private $cpf_usuario;
    private $contato_usuario;
    private $senha_usuario;
    private $data_nasc_usuario;
    private $setor_usuario;
    private $cargo_usuario;

    public function __construct($nome, $email, $cpf, $contato, $senha, $data_nasc, $setor, $cargo) {
        $this->nome_usuario = $nome;
        $this->setEmail($email);
        $this->cpf_usuario = $cpf;
        $this->contato_usuario = $contato;
        $this->setSenha($senha); // Armazena a senha já com hash
        $this->data_nasc_usuario = $data_nasc;
        $this->setor_usuario = $setor;
        $this->cargo_usuario = $cargo;
    }

    // Métodos GET e SET

    public function getId() {
        return $this->id;
    }

    public function getNome() {
        return $this->nome_usuario;
    }

    public function setNome($nome) {
        $this->nome_usuario = $nome;
    }

    public function getEmail() {
        return $this->email_usuario;
    }

    public function setEmail($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->email_usuario = $email;
        } else {
            throw new Exception("Email inválido.");
        }
    }

    public function getCpf() {
        return $this->cpf_usuario;
    }

    public function setCpf($cpf) {
        $this->cpf_usuario = $cpf;
    }

    public function getContato() {
        return $this->contato_usuario;
    }

    public function setContato($contato) {
        $this->contato_usuario = $contato;
    }

    public function getSenha() {
        return $this->senha_usuario;
    }

    public function setSenha($senha) {
        $this->senha_usuario = password_hash($senha, PASSWORD_BCRYPT);
    }

    public function getDataNasc() {
        return $this->data_nasc_usuario;
    }

    public function setDataNasc($data_nasc) {
        $this->data_nasc_usuario = $data_nasc;
    }

    public function getSetor() {
        return $this->setor_usuario;
    }

    public function setSetor($setor) {
        $this->setor_usuario = $setor;
    }

    public function getCargo() {
        return $this->cargo_usuario;
    }

    public function setCargo($cargo) {
        $this->cargo_usuario = $cargo;
    }

    // Método para cadastrar usuário
    public function cadastrar($conn) {
        $sql = "INSERT INTO usuario_comum (nome_usuario, email_usuario, cpf_usuario, contato_usuario, senha_usuario, data_nasc_usuario, setor_usuario, cargo_usuario)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $this->nome_usuario);
        $stmt->bindParam(2, $this->email_usuario);
        $stmt->bindParam(3, $this->cpf_usuario);
        $stmt->bindParam(4, $this->contato_usuario);
        $stmt->bindParam(5, $this->senha_usuario);
        $stmt->bindParam(6, $this->data_nasc_usuario);
        $stmt->bindParam(7, $this->setor_usuario);
        $stmt->bindParam(8, $this->cargo_usuario);
        $stmt->execute();
        $this->id = $conn->lastInsertId();
    }

    // Função para login de usuário
    public static function login($conn, $email, $senha) {
        $sql = "SELECT * FROM usuario_comum WHERE email_usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $email);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senha, $usuario['senha_usuario'])) {
            return $usuario;   
        }
        return false;
    }

    // Função para listar equipamentos alugados por este usuário
    public static function listarEquipamentosAlugados($conn, $idUsuario) {
        $sql = "SELECT * FROM aluguel a JOIN equipamentos e ON a.id_equip_aluguel = e.id_equipamento WHERE a.id_usuario_aluguel = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $idUsuario);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Método para salvar a requisição de aluguel no banco
    public function solicitarAluguel($conn) {
        $sql = "INSERT INTO aluguel (id_usuario_aluguel, id_equip_aluguel, obs_aluguel, aluguel_data_saida, aluguel_data_devolucao) 
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(1, $this->id_usuario);
        $stmt->bindParam(2, $this->id_equipamento);
        $stmt->bindParam(3, $this->obs);
        $stmt->bindParam(4, $this->data_saida);
        $stmt->bindParam(5, $this->data_devolucao);
        $stmt->execute();
        $this->id = $conn->lastInsertId();
    }

    // Método para listar todas as requisições de aluguel
    public static function listarAlugueis($conn) {
        $sql = "SELECT * FROM aluguel";
        $stmt = $conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public static function excluir($conn, $id) {
        $sql = "DELETE FROM usuario_comum WHERE id_USUARIO_COMUM = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }
    public static function listar($conn) {
        $sql = "SELECT * FROM usuario_comum";
        $stmt = $conn->query($sql);
        $usuarios = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $usuarios[] = new Usuario(
                $row['nome_usuario'],
                $row['email_usuario'],
                $row['cpf_usuario'],
                $row['contato_usuario'],
                $row['senha_usuario'], // Você pode querer omitir a senha aqui
                $row['data_nasc_usuario'],
                $row['setor_usuario'],
                $row['cargo_usuario']
            );
            $usuarios[count($usuarios) - 1]->id = $row['id_USUARIO_COMUM']; // Atribuir o ID ao objeto
        }
        return $usuarios;
    }
}


?>
