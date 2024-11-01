document.addEventListener("DOMContentLoaded", function () {
    const formAluguel = document.getElementById("aluguelForm");

    if (formAluguel) {
        formAluguel.addEventListener("submit", function (event) {
            event.preventDefault(); // Evita o reload da página

            // Coletando os valores do formulário
            const matricula = document.getElementById("matricula").value;
            const solicitante = document.getElementById("solicitante").value;
            const equipamento = document.getElementById("equipamento").value;
            const dataRetirada = document.getElementById("dataRetirada").value;
            const dataDevolucao = document.getElementById("dataDevolucao").value;
            const descricao = document.getElementById("descricao").value;

            // Verifica se todos os campos estão preenchidos
            if (!matricula || !solicitante  || !equipamento || !dataRetirada || !dataDevolucao || !descricao) {
                alert("Preencha todos os campos!");
                return;
            }

            // Enviar a solicitação para o backend
            fetch("http://localhost:9000/api/solicitacoes/criar", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    matricula: matricula,
                    solicitante: solicitante,
                    equipamento: equipamento,
                    dataRetirada: dataRetirada,
                    dataDevolucao: dataDevolucao,
                    descricao: descricao
                })
            })
            .then(response => response.json())
            .then(data => {
                alert("Solicitação criada com sucesso!");
                window.location.reload(); // Recarrega a página após sucesso
            })
            .catch(error => {
                console.error("Erro ao criar solicitação:", error);
                alert("Erro ao criar solicitação.");
            });
        });
    } else {
        console.error("Formulário de aluguel não encontrado.");
    }
});
