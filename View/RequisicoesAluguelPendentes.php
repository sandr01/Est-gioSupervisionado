<?php
require_once "../Controller/AluguelController.php";

$aluguelController = new AluguelController();
$solicitacoesPendentes = $aluguelController->listarSolicitacoesPendentes();
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
        <h2>Solicitaçoes</h2><br>
        <div class="table">
                <table>
                        <tr>
                            <th>Nome do Solicitante</th>
                            <th>Equipamento Solicitado</th>
                            <th>Observações</th>
                            <th>Data de Saída</th>
                            <th>Data de Devolução</th>
                            <th>Quantidade Solicitada</th> <!-- Nova coluna adicionada -->
                            <th>Status</th>
                        </tr>
                        <?php if (!empty($solicitacoesPendentes)): ?>
                <?php foreach ($solicitacoesPendentes as $solicitacao): ?>
                    <tr>
                        <td><?= htmlspecialchars($solicitacao['nome_usuario']) ?></td>
                        <td><?= htmlspecialchars($solicitacao['nome_equipamento']) ?></td>
                        <td><?= htmlspecialchars($solicitacao['obs_aluguel']) ?></td>
                        <td><?= htmlspecialchars($solicitacao['aluguel_data_saida']) ?></td>
                        <td><?= htmlspecialchars($solicitacao['aluguel_data_devolucao']) ?></td>
                        <td><?= htmlspecialchars($solicitacao['quantidade_solicitada']) ?></td> <!-- Exibindo a quantidade solicitada -->
                        <td>
                            <form method="post" action="../Controller/rota.php?acao=aprovarSolicitacao">
                                <input type="hidden" name="quantidade_solicitada" value="<?= htmlspecialchars($solicitacao['quantidade_solicitada']) ?>">
                                <input type="hidden" name="idaluguel" value="<?= htmlspecialchars($solicitacao['idaluguel']) ?>">
                                <select name="status">
                                    <option value="aprovado">Aprovar</option>
                                    <option value="recusado">Recusar</option>
                                </select>
                                <button type="submit">Atualizar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="7">Não há requisições de aluguel no momento.</td>
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
