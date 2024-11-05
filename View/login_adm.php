<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login do Administrador</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../Css/style.css"> 
</head>
<body>
    <div class="login-container">
        <div class="login-form">
                <img src="../img/login.png" alt="Imagem de Login" class="login-image">
                    <h2>Login do Administrador</h2>
                    <form action="../Controller/rota.php?acao=logar" method="POST">
                        <div class="form-group">
                            <label for="email_administrador">E-mail:</label>
                            <input type="email" id="email_administrador" name="email_administrador" placeholder="Digite seu e-mail" required>
                        </div>
                        <div class="form-group">
                            <label for="senha_administrador">Senha:</label>
                            <input type="password" id="senha_administrador" name="senha_administrador" placeholder="Digite sua senha" required>
                        </div>
                        <div class="form-group">
                            <button type="submit">Entrar</button>
                        </div>
                    </form>
                    <div class="footer">
                        <p>Esqueceu a senha? <a href="login_usuario.php">Clique aqui</a></p>
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
