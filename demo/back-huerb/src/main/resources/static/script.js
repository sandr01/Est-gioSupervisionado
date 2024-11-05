document.addEventListener("DOMContentLoaded", function () {
    // Evitar fazer a verificação do userType na página de login
    const isLoginPage = window.location.pathname.includes("login.html");

    if (!isLoginPage) {
        // Verifica o tipo de usuário no localStorage apenas se não estiver na página de login
        let userType = localStorage.getItem('userType'); // 'solicitante' ou 'admin'

        if (!userType) {
            // Redireciona para a página de login se o usuário não estiver autenticado
            window.location.href = "login.html";
        }

        // Seleciona o menu, garantindo que ele exista antes de manipular
        const menu = document.querySelector("#menu nav ul");
        if (menu) {
            // Limpa o menu existente se necessário
            //menu.innerHTML = '';

            if (userType === 'admin') {
                // Menu para Administrador (sem Aluguel, com Solicitações)
                menu.innerHTML = `
                    <li><a href="home.html">Home</a></li>
                    <li><a href="cadastro.html">Cadastro de Equipamentos</a></li>
                    <li><a href="cadastroUsuario.html">Cadastro de Usuários</a></li>
                    <li><a href="solicitacoes.html">Solicitações</a></li>
                    <li><a href="estoque.html">Estoque</a></li>
                    <li><a href="relatorio.html">Relatório</a></li>
                    <li><a href="#" id="logout">Logout</a></li>
                `;
            } else if (userType === 'solicitante') {
                // Menu para Funcionário Solicitante (com Aluguel)
                menu.innerHTML = `
                    <li><a href="home.html">Home</a></li>
                    <li><a href="aluguel.html">Aluguel</a></li>
                    <li><a href="#" id="logout">Logout</a></li>
                `;
            } else {
                alert("Tipo de usuário inválido!");
                window.location.href = "login.html"; // Redireciona para a página de login se houver erro
            }

            // Adiciona a funcionalidade de Logout
            const logoutLink = document.getElementById('logout');
            if (logoutLink) {
                logoutLink.addEventListener('click', function (event) {
                    event.preventDefault();
                    localStorage.removeItem('userType'); // Remove o tipo de usuário do localStorage
                    window.location.href = "login.html"; // Redireciona para a página de login
                });
            }
        } else {
            console.error("Elemento 'menu' não encontrado!");
        }
    }
});

// Função de login
document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const email = document.getElementById("username").value;  // Usar o campo visual de 'username' como email
    const password = document.getElementById("password").value;

    if (email && password) {
        // Faz a requisição para o back-end para autenticar o usuário
        fetch("http://localhost:9000/api/login", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({
                email: email,
                password: password
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                localStorage.setItem('userType', data.userType); // Salva o tipo de usuário no localStorage
                alert(`Bem-vindo, ${data.userType === 'admin' ? 'Administrador' : 'Funcionário Solicitante'}!`);
                window.location.href = "home.html"; // Redireciona para a página Home
            } else {
                alert("Falha no login. Verifique seu e-mail e senha.");
            }
        })
        .catch(error => {
            console.error("Erro ao fazer login:", error);
            alert("Ocorreu um erro ao tentar fazer login.");
        });
    } else {
        alert("Preencha todos os campos!");
    }

})