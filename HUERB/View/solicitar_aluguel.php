<?php
require_once "../Conexao/Conexao.php";
require_once "../Controller/EquipamentoController.php";
session_start();

if (!isset($_SESSION['usuario']['id_USUARIO_COMUM'])) {
    header('Location: login_usuario.php');
    exit();
}

$equipamentoController = new EquipamentoController();
$equipamentos = $equipamentoController->listar();

$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Solicitar Aluguel de Equipamento</title>
    <link rel="stylesheet" href="../Css/style.css">
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const today = new Date().toISOString().split("T")[0];
            const dataSaida = document.getElementById("data_saida");
            const dataDevolucao = document.getElementById("data_devolucao");

            dataSaida.setAttribute("min", today);
            
            dataSaida.addEventListener("change", function() {
                dataDevolucao.setAttribute("min", dataSaida.value);
            });

            document.getElementById("clear-form").addEventListener("click", function(event) {
                event.preventDefault();
                document.querySelector("form").reset();
            });
        });
    </script>
    
</head>
<body>
<div class="container">
        <div class="sidebar" id="menu">
        <img src="../img/pronto_socorro.png" alt="Imagem de Login" class="logo">
            <nav>
            <ul>
                    <li><a onclick="window.location.href='../View/dashboard_usuario.php'">Equipamentos</a></li>
                    <li><a onclick="window.location.href='../View/solicitar_aluguel.php'">Soliciar Aluguel</a></li>
                    <li><a onclick="window.location.href='../View/login_usuario.php'">Sair</a></li>
                </ul>
            </nav>
        </div>
    <div class="container">
                <div class="content">
                    <div class="form">
                            <h2>Solicitar Aluguel de Equipamento</h2>
                            
                            <form action="../Controller/rota.php?acao=solicitarAluguel" method="post">
            <input type="hidden" name="id_usuario_aluguel" value="<?= $_SESSION['usuario']['id_USUARIO_COMUM'] ?>">
            
            <label for="equipamento">Selecione o Equipamento:</label>
                                <select name="id_equip_aluguel" id="equipamento" required>
                                    <option value="">Selecione um equipamento</option>
                                    <?php foreach ($equipamentos as $equipamento): ?>
                                        <option value="<?= htmlspecialchars($equipamento->getId()) ?>">
                                            <?= htmlspecialchars($equipamento->getNome()) ?> - <?= htmlspecialchars($equipamento->getTipo()) ?>
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                                
                                <label for="quantidade">Quantidade:</label>
                                <input type="number" name="quantidade" id="quantidade" min="1" placeholder="Informe a quantidade desejada" required>
                                
                                <label for="obs_aluguel">Observações:</label>
                                <input type="text" name="obs_aluguel" id="obs_aluguel" placeholder="Especifique o motivo do aluguel" required>
                                
                                <label for="data_saida">Data de Saída:</label>
                                <input type="date" name="aluguel_data_saida" id="data_saida" required>
                                
                                <label for="data_devolucao">Data de Devolução:</label>
                                <input type="date" name="aluguel_data_devolucao" id="data_devolucao" required>
                                
                                <button type="submit" class="update-button" onclick="confirmarDevolucao(this.form)">Solicitar Aluguel</button>
                                <button id="clear-form" class="cancel-button">Limpar Campos</button>
                            </form>
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
