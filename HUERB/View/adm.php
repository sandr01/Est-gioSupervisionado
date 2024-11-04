<?php
require_once "../Model/Administrador.php";
require_once "../Controller/EquipamentoController.php";
require_once "../Controller/AluguelController.php"; 
require_once "../Controller/AdministradorController.php";
session_start();

if (!isset($_SESSION['admin'])) {
    header('Location: login_adm.php'); 
    exit();
}

$equipamentoController = new EquipamentoController();
$aluguelController = new AluguelController(); // Instanciando o controlador de aluguel

// Listando todos os equipamentos
$equipamentos = $equipamentoController->listar();

// Listando todas as requisições de aluguel pendentes
$solicitacoesPendentes = $aluguelController->listarSolicitacoesPendentes();

// Listando todos os equipamentos emprestados
$equipamentosEmprestados = $aluguelController->listarEquipamentosAprovados();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel do Administrador</title>
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
        <!-- Tabela de Equipamentos Emprestados -->
        <div class="content">
        <h2>Equipamentos Emprestados</h2>
        <div class="table">
        <table>
            <tr>
            <th>ID Equipamento</th>
            <th>Nome do Equipamento</th>
            <th>Nome do Usuário</th> 
            <th>Quantidade Solicitada</th>
            <th>Data da Solicitação</th> 
            <th>Ações</th>
            </tr>
            <?php if (!empty($equipamentosEmprestados)): ?>
        <?php foreach ($equipamentosEmprestados as $equipamento): ?>
            <tr>
                <td><?= htmlspecialchars($equipamento['idequipamento']) ?></td>
                <td><?= htmlspecialchars($equipamento['nome_equipamento']) ?></td>
                <td><?= htmlspecialchars($solicitacao['nome_usuario']) ?></td> 
                <td><?= htmlspecialchars($equipamento['quantidade']) ?></td>
                <td><?= htmlspecialchars($equipamento['aluguel_data_saida']) ?></td> 
                <td>
                    <!-- Botão "Detalhes" que mostra informações adicionais -->
                    <button class= "cancel-button" onclick="mostrarDetalhes(<?= htmlspecialchars(json_encode($equipamento)) ?>)">Detalhes</button>
                    
                    <!-- Botão "Devolvido" com confirmação -->
                    <form method="post" action="../Controller/rota.php?acao=devolverEquipamento" style="display:inline;">
                        <input type="hidden" name="idequipamento" value="<?= htmlspecialchars($equipamento['idequipamento']) ?>">
                        <input type="hidden" name="quantidade_devolvida" value="<?= htmlspecialchars($equipamento['quantidade']) ?>"> <!-- Mudando para quantidade_devolvida -->
                        <button class="update-button" onclick="confirmarDevolucao(this.form)">Devolvido</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6">Não há equipamentos emprestados no momento.</td> <!-- Ajustando o colspan -->
        </tr>
    <?php endif; ?>
</table>
<script>
            function mostrarDetalhes(equipamento) {
                alert("ID Equipamento: " + equipamento.idequipamento + "\n" +
                      "Nome: " + equipamento.nome_equipamento + "\n" +
                      "Quantidade: " + equipamento.quantidade);
            }

            function confirmarDevolucao(form) {
                if (confirm("Tem certeza de que deseja confirmar a devolução deste equipamento?")) {
                    form.submit();
                }
            }
        </script>
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