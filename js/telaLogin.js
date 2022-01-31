function verificarLogin() {
    var usuarioFormulario = document.getElementById("login")
    var senhaFormulario = document.getElementById("senha")

    if(usuarioFormulario.value.length == 0) {
        usuarioFormulario.focus();
        Swal.fire('Erro', 'Preencha seu usuário corretamente!', 'error');
        return false;
    }
    if(senhaFormulario.value.length == 0) {
        senhaFormulario.focus();
        Swal.fire('Erro!', 'Preencha sua senha corretamente!', 'error');
        return false;
    }
    return true
}