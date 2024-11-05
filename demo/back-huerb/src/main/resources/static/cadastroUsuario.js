document.getElementById("cadastroUsuarioForm").addEventListener("submit", function(event) {
    event.preventDefault();

    const nome = document.getElementById("nome").value;  // Capturando o nome
    const email = document.getElementById("email").value;  // Capturando o email
    const senha = document.getElementById("senha").value;  // Capturando a senha
    const tipo = document.getElementById("tipo").value;  // Capturando o tipo de usuário

    // Verificação para garantir que todos os campos estão preenchidos
    if (!nome || !email || !senha || !tipo) {
        alert("Preencha todos os campos!");
        return;
    }

    // Envio dos dados para o backend
    fetch("http://localhost:9000/api/usuarios/cadastrar", {  // Altere para a URL correta do seu back-end
        method: "POST",
        headers: {
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            nome: nome,
            email: email,
            senha: senha,  // Enviar a senha
            tipo: tipo     // Enviar o tipo de usuário
        })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error("Erro ao cadastrar o usuário.");
        }
        return response.json();
    })
    .then(data => {
        alert("Usuário cadastrado com sucesso!");
        document.getElementById("cadastroUsuarioForm").reset();  // Limpar o formulário após cadastro
    })
    .catch(error => {
        console.error("Erro ao cadastrar usuário:", error);
        alert("Erro ao cadastrar usuário.");
    });
});
