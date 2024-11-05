<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro do Administrador</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            justify-content: center;
            align-items: flex-start; /* Alinhamento modificado para evitar o corte */
            min-height: 100vh;
            background: linear-gradient(135deg, #74ebd5, #ACB6E5);
            color: #333;
            padding: 20px; /* Adiciona espaçamento para telas pequenas */
        }
        .cadastro-container {
            background-color: white;
            padding: 40px 30px;
            border-radius: 10px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            text-align: center;
            margin-top: 20px; /* Evita o corte na parte superior */
        }
        .cadastro-container h2 {
            margin-bottom: 25px;
            font-size: 1.8rem;
            color: #007bff;
        }
        .form-group {
            margin-bottom: 20px;
            text-align: left;
        }
        .form-group label {
            font-size: 0.9rem;
            margin-bottom: 8px;
            color: #555;
            display: inline-block;
        }
        .form-group input {
            width: 100%;
            padding: 12px;
            border: 2px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }
        .form-group input:focus {
            border-color: #007bff;
            outline: none;
        }
        .form-group button {
            width: 100%;
            padding: 12px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }
        .form-group button:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }
        .form-group button:active {
            transform: translateY(0);
        }
        
        /* Responsividade para telas menores */
        @media (max-width: 768px) {
            body {
                height: auto;
                padding: 10px;
            }
            .cadastro-container {
                padding: 20px 15px;
            }
            .cadastro-container h2 {
                font-size: 1.5rem;
            }
            .form-group input {
                padding: 10px;
            }
            .form-group button {
                padding: 10px;
                font-size: 0.9rem;
            }
        }

        @media (max-width: 480px) {
            .cadastro-container {
                width: 100%;
                max-width: 100%;
                padding: 15px 10px;
            }
            .cadastro-container h2 {
                font-size: 1.4rem;
            }
            .form-group input {
                padding: 8px;
            }
            .form-group button {
                padding: 8px;
                font-size: 0.85rem;
            }
        }
    </style>
</head>
<body>
    <div class="cadastro-container">
        <h2>Cadastro do Administrador</h2>
        <form id="Form" action="../Controller/rota.php?acao=cadastrar" method="POST">
            <div class="form-group">
                <label for="nome_administrador">Nome:</label>
                <input type="text" id="nome_administrador" name="nome_administrador" placeholder="Digite o nome completo" required>
            </div>
            <div class="form-group">
                <label for="email_administrador">E-mail:</label>
                <input type="email" id="email_administrador" name="email_administrador" placeholder="Digite o e-mail" required>
            </div>
            <div class="form-group">
                <label for="cpf_administrador">CPF:</label>
                <input type="text" id="cpf_administrador" name="cpf_administrador" maxlength="14" placeholder="000.000.000-00" required>
            </div>
            <div class="form-group">
                <label for="senha_administrador">Senha:</label>
                <input type="password" id="senha_administrador" name="senha_administrador" placeholder="Digite a senha" required>
            </div>
            <div class="form-group">
                <label for="data_nasc_administrador">Data de Nascimento:</label>
                <input type="date" id="data_nasc_administrador" name="data_nasc_administrador" required>
            </div>
            <div class="form-group">
                <label for="contato_administrador">Contato:</label>
                <input type="text" id="contato_administrador" name="contato_administrador" placeholder="Telefone ou celular" required>
            </div>
            <div class="form-group">
                <label for="cargo_administrador">Cargo:</label>
                <input type="text" id="cargo_administrador" name="cargo_administrador" placeholder="Cargo do administrador" required>
            </div>
            <div class="form-group">
                <label for="setor_administrador">Setor:</label>
                <input type="text" id="setor_administrador" name="setor_administrador" placeholder="Setor de atuação" required>
            </div>
            <div class="form-group">
                <button type="submit">Cadastrar</button>
            </div>
        </form>
    </div>
</body>
<script src="../Js/index.js"></script>
</html>
