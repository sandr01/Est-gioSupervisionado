// Carrega as solicitações pendentes e aprovadas
function carregarSolicitacoes() {
    fetch("http://localhost:9000/api/solicitacoes/listar")
        .then(response => response.json())
        .then(solicitacoes => {
            solicitacoes.forEach(solicitacao => {
                adicionarSolicitacaoNaTabela(solicitacao);
            });
        })
        .catch(error => {
            console.error("Erro ao carregar solicitações:", error);
        });
}

// Função para adicionar solicitação na tabela
function adicionarSolicitacaoNaTabela(solicitacao) {
    const tabela = document.getElementById("solicitacoesBody");

    const novaLinha = tabela.insertRow();
    novaLinha.insertCell(0).textContent = solicitacao.matricula;
    novaLinha.insertCell(1).textContent = solicitacao.solicitante;
    novaLinha.insertCell(2).textContent = solicitacao.equipamento;
    novaLinha.insertCell(3).textContent = new Date(solicitacao.dataRetirada).toLocaleDateString('pt-BR');
    novaLinha.insertCell(4).textContent = new Date(solicitacao.dataDevolucao).toLocaleDateString('pt-BR');
    novaLinha.insertCell(5).textContent = solicitacao.status;
    novaLinha.insertCell(6).textContent = solicitacao.descricao;

    const acoesCelula = novaLinha.insertCell(7);

    if (solicitacao.status === "PENDENTE") {
        const botaoAprovar = document.createElement("button");
        botaoAprovar.textContent = "Aprovar";
        botaoAprovar.onclick = function() {
            atualizarStatusSolicitacao(solicitacao.id, "APROVADO");
        };
        acoesCelula.appendChild(botaoAprovar);

        const botaoRecusar = document.createElement("button");
        botaoRecusar.textContent = "Recusar";
        botaoRecusar.onclick = function() {
            atualizarStatusSolicitacao(solicitacao.id, "REJEITADO");
        };
        acoesCelula.appendChild(botaoRecusar);

        const botaoAnalisar = document.createElement("button");
        botaoAnalisar.textContent = "Analisar";
        acoesCelula.appendChild(botaoAnalisar);

    } else if (solicitacao.status === "APROVADO") {
        const botaoVisualizar = document.createElement("button");
        botaoVisualizar.textContent = "Visualizar";
        acoesCelula.appendChild(botaoVisualizar);
    }
}

// Função para atualizar o status da solicitação
function atualizarStatusSolicitacao(id, status) {
    fetch(`http://localhost:9000/api/solicitacoes/atualizar/${id}`, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify(status)
    })
    .then(response => response.json())
    .then(data => {
        window.location.reload(); // Recarrega a página
    })
    .catch(error => {
        console.error("Erro ao atualizar status:", error);
        alert("Erro ao atualizar status.");
    });
}

// Carrega as solicitações ao abrir a página
document.addEventListener("DOMContentLoaded", carregarSolicitacoes);
