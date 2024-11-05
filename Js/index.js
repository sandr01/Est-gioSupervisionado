
function validaCPF(cpf) {
    cpf = cpf.replace(/\D+/g, '');  // Remove todos os caracteres não numéricos
    if (cpf.length !== 11) return false;

    let soma = 0;
    let resto;

    // Verifica se todos os dígitos são iguais (como 111.111.111-11)
    if (/^(\d)\1{10}$/.test(cpf)) return false;

    // Cálculo do primeiro dígito verificador
    for (let i = 1; i <= 9; i++) {
        soma += parseInt(cpf.substring(i-1, i)) * (11 - i);
    }
    resto = (soma * 10) % 11;
    if (resto === 10 || resto === 11) resto = 0;
    if (resto !== parseInt(cpf.substring(9, 10))) return false;

    // Cálculo do segundo dígito verificador
    soma = 0;
    for (let i = 1; i <= 10; i++) {
        soma += parseInt(cpf.substring(i-1, i)) * (12 - i);
    }
    resto = (soma * 10) % 11;
    if (resto === 10 || resto === 11) resto = 0;
    if (resto !== parseInt(cpf.substring(10, 11))) return false;

    return true;
}

document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('Form').addEventListener('submit', function(e) {
        var cpf = document.getElementById('cpf_administrador').value;
        if (!validaCPF(cpf)) {
            e.preventDefault();
            alert('CPF inválido. Verifique o número digitado.');
            document.getElementById('cpf_administrador').focus();
        }
    });

    document.getElementById('cpf_administrador').addEventListener('input', function(e) {
        var value = e.target.value;
        var cpfPattern = value.replace(/\D/g, '') // Remove não números
                              .replace(/(\d{3})(\d)/, '$1.$2') // Adiciona primeiro ponto
                              .replace(/(\d{3})(\d)/, '$1.$2') // Adiciona segundo ponto
                              .replace(/(\d{3})(\d{1,2})$/, '$1-$2'); // Adiciona traço e dígitos finais
        e.target.value = cpfPattern;
    });
});


var phoneInput = document.getElementById("contato_administrador");
var myForm = document.forms.myForm;
var result = document.getElementById("result"); // only for debugging purposes

phoneInput.addEventListener("input", function (e) {
  var x = e.target.value
    .replace(/\D/g, "")
    .match(/(\d{0,2})(\d{0,5})(\d{0,4})/);
  e.target.value = !x[2]
    ? x[1]
    : "(" + x[1] + ") " + x[2] + (x[3] ? "-" + x[3] : "");
});

myForm.addEventListener("submit", function (e) {
  phoneInput.value = phoneInput.value.replace(/\D/g, "");
  result.innerText = phoneInput.value; // only for debugging purposes

  e.preventDefault(); // You wouldn't prevent it
});

function limparCampos() {
    document.getElementById("aluguelForm").reset();
}