document.addEventListener("DOMContentLoaded", function() {
    carregarSolicitacoesAprovadas();
});

// Função para carregar solicitações aprovadas
function carregarSolicitacoesAprovadas() {
    fetch("http://localhost:9000/api/solicitacoes/aprovadas") // Altere para a URL correta do seu back-end
        .then(response => response.json())
        .then(solicitacoes => {
            const tabelaRelatorio = document.getElementById("relatorio-table");

            solicitacoes.forEach(solicitacao => {
                const row = document.createElement("tr");
                
                row.innerHTML = `
                    <td>${solicitacao.matricula}</td>
                    <td>${solicitacao.solicitante}</td>
                    <td>${solicitacao.equipamento}</td>
                    <td>${new Date(solicitacao.dataRetirada).toLocaleDateString('pt-BR')}</td>
                    <td>${new Date(solicitacao.dataDevolucao).toLocaleDateString('pt-BR')}</td>
                    <td>${solicitacao.status}</td>
                    <td>
                        ${solicitacao.status !== 'Devolvido' 
                            ? `<button class="devolverBtn" data-id="${solicitacao.id}">Marcar como Devolvido</button>` 
                            : 'Devolvido'}
                    </td>
                `;

                tabelaRelatorio.appendChild(row);
            });

            // Adiciona eventos aos botões de "Marcar como Devolvido"
            document.querySelectorAll(".devolverBtn").forEach(button => {
                button.addEventListener("click", function() {
                    const solicitacaoId = this.getAttribute("data-id");
                    marcarComoDevolvido(solicitacaoId);
                });
            });
        })
        .catch(error => {
            console.error("Erro ao carregar as solicitações:", error);
        });
}

// Função para marcar uma solicitação como devolvida
function marcarComoDevolvido(id) {
    fetch(`http://localhost:9000/api/solicitacoes/marcarDevolvido/${id}`, {
        method: "PUT",
        headers: {
            "Content-Type": "application/json"
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error("Erro ao atualizar o status de devolução.");
        }
        return response.json();
    })
    .then(() => {
        alert("Solicitação marcada como devolvida com sucesso!");
        window.location.reload(); // Recarrega a página para atualizar o status
    })
    .catch(error => {
        console.error("Erro ao marcar como devolvido:", error);
        alert("Erro ao marcar como devolvido.");
    });
}
