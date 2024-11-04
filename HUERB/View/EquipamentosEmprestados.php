<?php
require_once "../Controller/AluguelController.php";

$aluguelController = new AluguelController();
$equipamentosEmprestados = $aluguelController->listarEquipamentosEmprestados();
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
        <h2>Relatorio</h2>
                    <table>
                        <tr>
                            <th>ID Equipamento</th>
                            <th>Nome do Equipamento</th>
                            <th>Quantidade</th>
                            <th>Ações</th>
                        </tr>
                        <?php if (!empty($equipamentosEmprestados)): ?>
                            <?php foreach ($equipamentosEmprestados as $equipamento): ?>
                                <tr>
                                    <td><?= htmlspecialchars($equipamento['id_equipamento']) ?></td>
                                    <td><?= htmlspecialchars($equipamento['nome_equipamento']) ?></td>
                                    <td><?= htmlspecialchars($equipamento['quantidade']) ?></td>
                                    <td>
                                        <button onclick="mostrarDetalhes(<?= htmlspecialchars(json_encode($equipamento)) ?>)">Detalhes</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="4">Não há equipamentos emprestados no momento.</td>
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
