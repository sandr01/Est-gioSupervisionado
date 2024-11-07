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
                    <div class="form">
                        <h1>Cadastro de Usuário</h1>
                        <form id="cadastroForm" action="../Controller/rota.php?acao=cadastrarUsuario" method="POST">
                            
                                <label for="nome_usuario">Nome:</label>
                                <input type="text" name="nome_usuario" id="nome_usuario" placeholder="Digite o nome completo" required>
                         
                            
                                <label for="email_usuario">Email:</label>
                                <input type="email" name="email_usuario" id="email_usuario" placeholder="Digite o e-mail" required>
                        
                         
                                <label for="cpf_usuario">CPF:</label>
                                <input type="text" name="cpf_usuario" id="cpf_usuario" maxlength="14" placeholder="000.000.000-00" required>
                        
                        
                                <label for="contato_usuario">Contato:</label>
                                <input type="text" name="contato_usuario" id="contato_usuario" placeholder="Telefone ou celular" required>
                         
                      
                                <label for="senha_usuario">Senha:</label>
                                <input type="password" name="senha_usuario" id="senha_usuario" placeholder="Digite a senha" required>
                       
                           
                                <label for="data_nasc_usuario">Data de Nascimento:</label>
                                <input type="date" name="data_nasc_usuario" id="data_nasc_usuario" required>
                        
                    
                                <label for="setor_usuario">Setor:</label>
                                <input type="text" name="setor_usuario" id="setor_usuario" placeholder="Setor de atuação" required>
                        
                    
                                <label for="cargo_usuario">Cargo:</label>
                                <input type="text" name="cargo_usuario" id="cargo_usuario" placeholder="Cargo do usuário" required>
                         
                     
                                <button type="submit">Cadastrar</button>
                        
                        </form>
                        <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const form = document.getElementById('formCadastro');
                                    const nomeInput = document.getElementById('nome_usuario');
                                    const cpfInput = document.getElementById('cpf_usuario');
                                    const telefoneInput = document.getElementById('contato_usuario');
                                    const dataNascimentoInput = document.getElementById('data_nasc_usuario');

                                    // Validação do campo "Nome" (sem números)
                                    nomeInput.addEventListener('input', function() {
                                        nomeInput.value = nomeInput.value.replace(/[0-9]/g, '');
                                    });

                                    // Validação e formatação do CPF
                                    cpfInput.addEventListener('input', function() {
                                        let value = cpfInput.value.replace(/\D/g, '');
                                        value = value.replace(/(\d{3})(\d)/, '$1.$2')
                                                    .replace(/(\d{3})(\d)/, '$1.$2')
                                                    .replace(/(\d{3})(\d{1,2})$/, '$1-$2');
                                        cpfInput.value = value;
                                    });

                                    // Validação do campo "Contato" (apenas números no formato (00) 0 0000-0000)
                                    telefoneInput.addEventListener('input', function() {
                                        let value = telefoneInput.value.replace(/\D/g, '');
                                        if (value.length > 11) value = value.substring(0, 11);
                                        if (value.length > 2) value = value.replace(/^(\d{2})(\d)/, '($1) $2');
                                        if (value.length > 7) value = value.replace(/^(\(\d{2}\) \d)(\d{4})(\d{4})$/, '$1 $2-$3');
                                        telefoneInput.value = value;
                                    });

                                    // Validação da data de nascimento (18 anos e não futuro)
                                    dataNascimentoInput.addEventListener('input', function() {
                                        const today = new Date();
                                        const birthDate = new Date(dataNascimentoInput.value);
                                        let age = today.getFullYear() - birthDate.getFullYear();
                                        const month = today.getMonth() - birthDate.getMonth();

                                        if (month < 0 || (month === 0 && today.getDate() < birthDate.getDate())) {
                                            age--;
                                        }

                                        if (age < 18 || birthDate > today) {
                                            alert('Data de nascimento inválida. O usuário deve ter pelo menos 18 anos e a data não pode estar no futuro.');
                                            dataNascimentoInput.value = '';
                                        }
                                    });

                                    // Exibir mensagem de confirmação ao enviar o formulário
                                    form.addEventListener('submit', function(event) {
                                        event.preventDefault(); // Impede o envio para exibir a mensagem primeiro
                                        alert('Usuário cadastrado com sucesso!');
                                        form.submit(); // Envia o formulário após a confirmação
                                    });
                                });
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
