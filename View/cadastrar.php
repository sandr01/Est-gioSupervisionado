
<?php
session_start();

if (!isset($_SESSION['admin'])) {
    header('Location: login_adm.html');
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Equipamento</title>
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
                <div class="form">
                        <h1>Cadastrar Equipamento</h1>
                        <form id="cadastroForm" action="../Controller/rota.php?acao=salvarEquipamento" method="POST">
                            <label for="nome">Nome do Equipamento:</label>
                            <input type="text" id="nome" name="nome" placeholder="Digite o nome do equipamento" required>

                            <label for="tipo">Tipo do Equipamento:</label>
                            <input type="text" id="tipo" name="tipo" placeholder="Digite o tipo do equipamento" required>

                            <label for="status">Status do Equipamento:</label>
                            <input type="text" id="status" name="status" placeholder="Digite o status do equipamento" required>

                            <label for="patrimonio">Número de Patrimônio:</label>
                            <input type="text" id="patrimonio" name="patrimonio" placeholder="Digite o número de patrimônio" required>

                            <label for="obs">Observações:</label>
                            <textarea id="obs" name="obs" rows="4" placeholder="Digite quaisquer observações"></textarea>

                            <label for="id_adm">ID do Administrador:</label>
                            <input type="text" id="id_adm" name="id_adm" placeholder="Digite o ID do administrador" required>

                            <label for="data_entrada">Data de Entrada:</label>
                            <input type="date" id="data_entrada" name="data_entrada" required>

                            <label for="quantidade">Quantidade:</label>
                            <input type="number" name="quantidade" id="quantidade" placeholder="Digite a quantidade" required min="1">

                            <button type="submit">Cadastrar Equipamento</button>
                        </form>

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
