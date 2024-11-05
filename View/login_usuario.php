<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login de Usuário</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../Css/style.css">
</head>
<body>
    <div class="login-container">
        <div class="login-form">
            <img src="../img/login.png" alt="Imagem de Login" class="login-image">
                <h2>Login de Usuário</h2>
                <form action="../Controller/rota.php?acao=logarUsuario" method="POST">
                <label for="email_usuario">E-mail:</label>
                        <input type="email" name="email_usuario" id="email_usuario" placeholder="Digite seu e-mail" required>

                        <label for="senha_usuario">Senha:</label>
                        <input type="password" name="senha_usuario" id="senha_usuario" placeholder="Digite sua senha" required>

                        <button type="submit">Entrar</button>
                    </form>
                    <p>Esqueceu a senha? <a href="login_adm.php">Clique aqui</a></p>
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
