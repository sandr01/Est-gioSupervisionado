document.addEventListener("DOMContentLoaded", function() {
    fetch("http://localhost:9000/api/equipamentos/listar")
    .then(response => response.json())
    .then(data => {
        const tabelaEstoque = document.getElementById("estoque-table");

        data.forEach(equipamento => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${equipamento.matricula}</td>
                <td>${equipamento.data}</td>
                <td>${equipamento.equipamento}</td>
                <td>${equipamento.quantidade}</td>
                <td>${equipamento.descricao}</td>
            `;
            tabelaEstoque.appendChild(row);
        });
    })
    .catch(error => {
        console.error("Erro ao buscar equipamentos:", error);
    });
});
