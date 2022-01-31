function validarFormulario() {
    var nomeFormulario = document.getElementById("nome")
    var emailFormulario = document.getElementById("email")
    var assuntoFormulario = document.getElementById("assunto")
    var numeroPedidoFormulario = document.getElementById("numeroPedido")
    var recadoFormulario = document.getElementById("recado")

    if (nomeFormulario.value.length == 0) {
        alert("Insira um nome!")
        nomeFormulario.focus()
        return false
    }
    if (email.value == "" || email.value.indexOf("@") == -1 ||
        email.value.indexOf(".") == -1) {
        alert("Insira um email!")
        emailFormulario.focus()
        return false
    }
    if (assuntoFormulario.value == "0") {
        alert("Selecione um tipo de assunto!")
        assuntoFormulario.focus()
        return false
    }
    if (numeroPedidoFormulario.value.length == 0 && assuntoFormulario.value == "4") {
        alert("Informe o número do pedido!")
        numeroPedidoFormulario.focus()
        return false
    }
    if (recadoFormulario.value = "0" || recadoFormulario.value.length < 2) {
        alert("Escreva algum recado!")
        recadoFormulario.focus()
        return false
    }
    alert("Email enviado com sucesso!")
    return true
}

function verificaAssunto(assunto) {

    if (assunto == "4") {
        document.getElementById("divNumeroPedido").style.display = "block";
    } else {
        document.getElementById("divNumeroPedido").style.display = "none";
    }

}