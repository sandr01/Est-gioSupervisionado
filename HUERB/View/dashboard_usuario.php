<?php
require_once "../Model/Administrador.php";
require_once "../Controller/EquipamentoController.php";
require_once "../Controller/AluguelController.php";
require_once "../Controller/UsuarioController.php"; 
session_start();
if (!isset($_SESSION['usuario']['id_USUARIO_COMUM'])) {
    header('Location: login_usuario.php');
    exit();
}

$controller = new UsuarioController();
$alugueis = $controller->listarAlugueisUsuario(); 

$equipamentoController = new EquipamentoController();
$equipamentos = $equipamentoController->listar();

$msg = isset($_GET['msg']) ? $_GET['msg'] : '';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tela Usuário</title>
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


                <div class="content">
                    <h1>Bem-vindo, <?= htmlspecialchars($_SESSION['usuario']['nome_usuario']) ?>!</h1>
                            <?php if ($msg): ?>
                                <p style="color: green;"><?= htmlspecialchars($msg) ?></p>
                            <?php endif; ?>
                        <h2>Seus Equipamentos Alugados</h2>
                            <div class="table">
        
                                    <?php if (!empty($alugueis)): ?>
                                    <table>
                                    <tr>
                                            <th>Equipamento</th>
                                            <th>Data de Saída</th>
                                            <th>Data de Devolução</th>
                                            <th>Status</th>
                                        </tr>
                                        <?php foreach ($alugueis as $aluguel): ?>
                                                <tr>
                                                    <td data-label="Equipamento"><?= htmlspecialchars($aluguel['nome_equipamento']) ?></td>
                                                    <td data-label="Data de Saída"><?= htmlspecialchars($aluguel['aluguel_data_saida']) ?></td>
                                                    <td data-label="Data de Devolução"><?= htmlspecialchars($aluguel['aluguel_data_devolucao']) ?></td>
                                                    <td data-label="Status"><?= htmlspecialchars($aluguel['status_aluguel']) ?></td>
                                                </tr>
                                         <?php endforeach; ?>
                                    </table>
                                    
                            </div>
                                    <?php else: ?>
                                        <p>Você não possui equipamentos alugados no momento.</p>
                                    <?php endif; ?>
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
                        </div>
</body>
</html>
