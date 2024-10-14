// Função para carregar os dados do relatório
function carregarRelatorio() {
    fetch("http://localhost:9000/api/solicitacoes/aprovadas")  // Altere conforme o endpoint do seu back-end
        .then(response => response.json())
        .then(solicitacoes => {
            solicitacoes.forEach(solicitacao => {
                adicionarSolicitacaoNaTabela(solicitacao);
            });
        })
        .catch(error => {
            console.error("Erro ao carregar o relatório:", error);
        });
}

// Função para adicionar a solicitação na tabela
function adicionarSolicitacaoNaTabela(solicitacao) {
    const tabela = document.querySelector("tbody");

    const novaLinha = tabela.insertRow();
    novaLinha.insertCell(0).textContent = solicitacao.matricula;
    novaLinha.insertCell(1).textContent = solicitacao.solicitante;
    novaLinha.insertCell(2).textContent = solicitacao.equipamento;
    novaLinha.insertCell(3).textContent = new Date(solicitacao.dataRetirada).toLocaleDateString('pt-BR');
    novaLinha.insertCell(4).textContent = new Date(solicitacao.dataDevolucao).toLocaleDateString('pt-BR');
    novaLinha.insertCell(5).textContent = solicitacao.status === "DEVOLVIDO" ? "Devolvido" : "Pendente";
}

// Carregar o relatório ao abrir a página
document.addEventListener("DOMContentLoaded", carregarRelatorio);
