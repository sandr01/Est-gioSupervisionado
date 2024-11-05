<?php
require_once "../Controller/EquipamentoController.php";

$equipamentoController = new EquipamentoController();
$equipamentos = $equipamentoController->listar();
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Usuário</title>
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
                        <h2>Lista de Equipamentos</h2>
                            <div class="table">
                            <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Tipo</th>
                <th>Quantidade</th>
                <th>Status</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($equipamentos as $equipamento): ?>
                <tr>
                    <td><?= htmlspecialchars($equipamento->getId()) ?></td>
                    <td><?= htmlspecialchars($equipamento->getNome()) ?></td>
                    <td><?= htmlspecialchars($equipamento->getTipo()) ?></td>
                    <td><?= htmlspecialchars($equipamento->getQuantidade()) ?></td>
                    <td><?= htmlspecialchars($equipamento->getStatus()) ?></td>
                    <td>
                        <!-- <button class="update-button" onclick="window.location.href='../Controller/EquipamentoController.php?acao=atualizar&id=<?= $equipamento->getId() ?>'">Atualizar</button> -->
                        <button class="cancel-button" onclick="if(confirm('Tem certeza que deseja remover este equipamento?')) { window.location.href='../Controller/EquipamentoController.php?acao=remover&id=<?= $equipamento->getId() ?>' }">Remover</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
            </div>
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
