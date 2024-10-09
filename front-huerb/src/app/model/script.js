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
            localStorage.removeItem('userType'); // Remove o tipo de usuário
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
        // Realiza a autenticação com o back-end
        fetch('http://localhost:9000/api/login', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                username: username,
                password: password
            })
        })
        .then(response => {
            if (response.ok) {
                return response.json();
            } else {
                throw new Error('Falha na autenticação');
            }
        })
        .then(data => {
            // Armazena o token JWT no localStorage para uso posterior
            localStorage.setItem('token', data.token);
            localStorage.setItem('userType', userType);

            alert(`Bem-vindo, ${userType === 'admin' ? 'Administrador' : 'Funcionário Solicitante'} ${username}!`);
            
            // Redireciona para a página Home
            window.location.href = "home.html";
        })
        .catch(error => {
            console.error('Erro na autenticação:', error);
            alert("Usuário ou senha incorretos.");
        });
    } else {
        alert("Preencha todos os campos!");
    }
});

// Função para verificar se o usuário está autenticado
function verificarAutenticacao() {
    const token = localStorage.getItem('token');
    if (!token) {
        alert("Você precisa estar logado para acessar esta página.");
        window.location.href = "login.html";
    }
}

// Função para realizar chamadas autenticadas ao back-end
function chamadaAutenticada(url, options) {
    const token = localStorage.getItem('token');
    if (!options.headers) {
        options.headers = {};
    }
    options.headers['Authorization'] = `Bearer ${token}`;

    return fetch(url, options);
}

// Exemplo de chamada autenticada para obter as solicitações
function carregarSolicitacoes() {
    chamadaAutenticada('http://localhost:9000/api/solicitacoes', {
        method: 'GET'
    })
    .then(response => response.json())
    .then(data => {
        const tableBody = document.querySelector('#solicitacoes-table tbody');
        tableBody.innerHTML = '';

        data.forEach(solicitacao => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${solicitacao.id}</td>
                <td>${solicitacao.usuario.nome}</td>
                <td>${solicitacao.equipamento.nome}</td>
                <td>${solicitacao.quantidade}</td>
                <td>${new Date(solicitacao.dataSolicitacao).toLocaleString('pt-BR')}</td>
                <td>${solicitacao.status}</td>
            `;
            tableBody.appendChild(row);
        });
    })
    .catch(error => {
        console.error('Erro ao carregar as solicitações:', error);
    });
}
