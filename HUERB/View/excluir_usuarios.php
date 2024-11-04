<?php
require_once "../Model/Usuario.php"; 
require_once "../Controller/UsuarioController.php"; 
session_start();

if (!isset($_SESSION['admin'])) {
    header('Location: login_adm.php'); 
    exit();
}

$usuarioController = new UsuarioController();
$usuarios = $usuarioController->listar(); 

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $usuarioController->excluir($id); 
    header('Location: excluir_usuarios.php'); 
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Excluir Usuários</title>
    <link rel="stylesheet" href="../Css/style.css">
</head>
<body>
<div class="container">
        <div class="sidebar" id="menu">
        <img src="../img/pronto_socorro.png" alt="Imagem de Login" class="logo">
            <nav>
            <ul>
                    <li><a onclick="window.location.href='../View/adm.php'">Home</a></li>
                    <li><a onclick="window.location.href='../View/cadastrar.php'">Cadastrar Equipamentos</a></li>
                    <li><a onclick="window.location.href='../View/cad_usuario.php'">Cadastrar Usuários</a></li>
                    <li><a onclick="window.location.href='excluir_usuarios.php'">Lista de Usuários</a></li>
                    <li><a onclick="window.location.href='../View/RequisicoesAluguelPendentes.php'">Solicitaçoes</a></li>
                    <li><a onclick="window.location.href='../View/ListaEquipamento.php'">Lista de Equipamentos</a></li>
                    <li><a onclick="window.location.href='../View/login_adm.php'">Sair</a></li>
                </ul>
            </nav>
        </div>
        <div class="content">
        <h2>Excluir Usuários</h2>
        <div class="table">
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Ações</th>
            </tr>
            <?php if (!empty($usuarios)): ?>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td><?= htmlspecialchars($usuario->getId()) ?></td>
                        <td><?= htmlspecialchars($usuario->getNome()) ?></td>
                        <td><?= htmlspecialchars($usuario->getEmail()) ?></td>
                        <td>
                            <button class="cancel-button" href="?delete=<?= $usuario->getId() ?>" onclick="return confirm('Tem certeza que deseja excluir este usuário?');">Excluir</button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Não há usuários cadastrados.</td>
                </tr>
            <?php endif; ?>
        </table>
        </div>
            </div>
            </div>
    <footer class="#">
        <div class="#">
            <div class="text-muted">Copyright &copy; todos os direitos reservados - Controle de Estoque do Setor de TI da HUERB</div>
        </div>
        <div>
            <a href="#">Política de privacidade</a>
           &middot;
           <a href="#">Termos &amp; Condições</a>
       </div>
    </footer>
</body>
</html>
