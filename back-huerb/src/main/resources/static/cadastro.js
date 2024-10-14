// Função para adicionar uma linha na tabela
function adicionarEquipamentoNaTabela(equipamento) {
    const tabela = document.getElementById("equipamentosBody");

    // Cria uma nova linha na tabela
    const novaLinha = tabela.insertRow();

    // Adiciona células na linha
    const matriculaCelula = novaLinha.insertCell(0);
    const dataCelula = novaLinha.insertCell(1);
    const equipamentoCelula = novaLinha.insertCell(2);
    const quantidadeCelula = novaLinha.insertCell(3);
    const descricaoCelula = novaLinha.insertCell(4);

    // Define os valores das células
    matriculaCelula.textContent = equipamento.matricula;
    dataCelula.textContent = new Date(equipamento.data).toLocaleDateString('pt-BR'); // Formato de data
    equipamentoCelula.textContent = equipamento.equipamento;
    quantidadeCelula.textContent = equipamento.quantidade;
    descricaoCelula.textContent = equipamento.descricao;

    const logoutLink = document.getElementById('logout');
        if (logoutLink) {
            logoutLink.addEventListener('click', function (event) {
                event.preventDefault();
                localStorage.removeItem('userType'); // Remove o tipo de usuário do localStorage
                window.location.href = "login.html"; // Redireciona para a página de login
            });
        }
        
}

// Função para carregar todos os equipamentos e exibi-los na tabela
function carregarEquipamentos() {
    fetch("http://localhost:9000/api/equipamentos/listar") // URL do seu back-end
        .then(response => response.json())
        .then(equipamentos => {
            equipamentos.forEach(equipamento => {
                adicionarEquipamentoNaTabela(equipamento);
            });
        })
        .catch(error => {
            console.error("Erro ao carregar os equipamentos:", error);
        });
}

// Função para cadastrar um novo equipamento
document.getElementById("cadastroForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const matricula = document.getElementById("matricula").value;
    const data = document.getElementById("data").value;
    const equipamento = document.getElementById("equipamento").value;
    const quantidade = document.getElementById("quantidade").value;
    const descricao = document.getElementById("descricao").value;

    // Enviar os dados para o back-end
    fetch("http://localhost:9000/api/equipamentos/cadastrar", {
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            matricula: matricula,
            data: data,
            equipamento: equipamento,
            quantidade: quantidade,
            descricao: descricao
        })
    })
    .then(response => response.json())
    .then(novoEquipamento => {
        // Adiciona o novo equipamento diretamente na tabela após o cadastro
        adicionarEquipamentoNaTabela(novoEquipamento);
        alert("Equipamento cadastrado com sucesso!");

        // Limpa o formulário
        document.getElementById("cadastroForm").reset();
    })
    .catch(error => {
        console.error("Erro ao cadastrar o equipamento:", error);
        alert("Erro ao cadastrar o equipamento.");
    });
});

// Carrega os equipamentos ao carregar a página
document.addEventListener("DOMContentLoaded", function () {
    carregarEquipamentos();
});
