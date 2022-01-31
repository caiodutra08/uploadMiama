function verificarAlteracao() {
    var nomeFormulario = document.getElementById("nome");
    var sobrenomeFormulario = document.getElementById("sobrenome");
    var emailFormulario = document.getElementById("email");
    var cpfFormulario = document.getElementById("cpf");
    var enderecoFormulario = document.getElementById("endereco");
    var telefoneFormulario = document.getElementById("telefone");

    if (nomeFormulario.value == "" || nomeFormulario.value.length < 3) {
        nomeFormulario.focus();
        Swal.fire('Erro!', 'Insira seu nome!', 'error');
        return false;
    }
    if (sobrenomeFormulario.value.length == 0) {
        sobrenomeFormulario.focus()
        Swal.fire('Erro!', 'Insira seu sobrenome!', 'error')
        return false;
    }

    if (emailFormulario.value == "" || emailFormulario.value.indexOf("@") == -1 ||
        emailFormulario.value.indexOf(".") == -1) {
        emailFormulario.focus();
        Swal.fire('Erro', 'Insira seu email!', 'error');
        return false;
    }
    if (cpfFormulario.value.length == 0) {
        cpfFormulario.focus();
        Swal.fire('Erro!', 'Insira seu cpf!', 'error');
        return false;
    }

    if (enderecoFormulario.value.length == 0) {
        enderecoFormulario.focus();
        Swal.fire('Erro', 'Insira seu endereço!', 'error');
        return false;
    }
    if (telefoneFormulario.value.length == 0) {
        telefoneFormulario.focus();
        Swal.fire('Erro!', 'Insira seu Telefone!', 'error');
        return false;
    }
}
