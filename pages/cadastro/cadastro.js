function formatarCPF() {
    let cpfInput = document.querySelector('.form-cpf');
    let cpf = cpfInput.value;
    cpf = cpf.replace(/\D/g, '');
    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
    cpf = cpf.replace(/(\d{3})(\d)/, '$1.$2');
    cpf = cpf.replace(/(\d{3})(\d{1,2})$/, '$1-$2');
    cpfInput.value = cpf;
}

function formatarTelefone() {
    let telefoneInput = document.querySelector('.form-telefone');
    let telefone = telefoneInput.value;
    telefone = telefone.replace(/\D/g, ''); 
    telefone = telefone.replace(/^(\d{2})(\d)/g, '($1) $2'); 
    telefone = telefone.replace(/(\d{5})(\d)/, '$1-$2'); 
    telefoneInput.value = telefone;
}