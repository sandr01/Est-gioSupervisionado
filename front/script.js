document.addEventListener("DOMContentLoaded", function () {
    // Verifica o tipo de usuário
    let userType = localStorage.getItem('userType'); // 'solicitante' ou 'admin'

    if (!userType) {
        // Simulação: substitua esta parte por uma lógica de autenticação real
        userType = prompt("Digite o tipo de usuário: 'admin' ou 'solicitante'");
        localStorage.setItem('userType', userType);
    }

    // Seleciona o menu
    const menu = document.querySelector("#menu nav ul");

    // Limpa o menu existente
    menu.innerHTML = '';

    if (userType === 'admin') {
        // Menu para Administrador (sem Aluguel, com Solicitações)
        menu.innerHTML = `
            <li><a href="home.html">Home</a></li>
            <li><a href="cadastro.html">Cadastro</a></li>
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
    }

    // Adiciona a funcionalidade de Logout
    const logoutLink = document.getElementById('logout');
    if (logoutLink) {
        logoutLink.addEventListener('click', function (event) {
            event.preventDefault();
            //localStorage.removeItem('userType'); // Remove o tipo de usuário
            window.location.href = "login.html"; // Redireciona para a página de login
        });
    }
});

// Função de login
document.getElementById("loginForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const userType = document.getElementById("userType").value;
    const username = document.getElementById("username").value;
    const password = document.getElementById("password").value;

    if (username && password) {
        localStorage.setItem('userType', userType);
        alert(`Bem-vindo, ${userType === 'admin' ? 'Administrador' : 'Funcionário Solicitante'} ${username}!`);
        
        // Redireciona para a página Home
        window.location.href = "home.html";
    } else {
        alert("Preencha todos os campos!");
    }
});
