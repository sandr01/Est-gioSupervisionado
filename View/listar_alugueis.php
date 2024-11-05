<?php
require_once "../Conexao/Conexao.php";
require_once "../Controller/UsuarioController.php";
session_start();

if (!isset($_SESSION['usuario']['id_USUARIO_COMUM'])) {
    header('Location: login_usuario.php');
    exit();
}

$controller = new UsuarioController();
$alugueis = $controller->listarAlugueisUsuario(); 
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Aluguéis</title>
    <link rel="stylesheet" href="../Css/style.css"> 
<body>
    <div class="container">
        <div class="section">
            <h2>Seus Equipamentos Alugados</h2>
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
                            <td><?= htmlspecialchars($aluguel['id_equip_aluguel']) ?></td>
                            <td><?= htmlspecialchars($aluguel['aluguel_data_saida']) ?></td>
                            <td><?= htmlspecialchars($aluguel['aluguel_data_devolucao']) ?></td>
                            <td><?= htmlspecialchars($aluguel['status_aluguel']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </table>
            <?php else: ?>
                <p>Você não possui equipamentos alugados no momento.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
