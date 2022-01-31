function verificarCadastroCategoria() {
    var inputNomeCategoria = document.getElementById("nomeCategoria");

    if (inputNomeCategoria.value.length == 0 || inputNomeCategoria.value == "") {
        inputNomeCategoria.focus();
        Swal.fire('Erro!', 'Insira uma categoria válida!', 'error');
        return false;
    }
}

function mostrarAnimacao() {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: 'success',
        title: 'Signed in successfully'
    })
}

function verificarCadastroProduto() {
    var nomeDoProdutoForm = document.getElementById("nomeProduto");
    var selectCategoriaForm = document.getElementById("selectCategoria");
    var precoProdutoForm = document.getElementById("selectCategoria");

    if(nomeDoProdutoForm.value.length == "") {
        nomeDoProdutoForm.focus();
        Swal.fire('Erro!', 'Insira um nome de produto válido!', 'error');
        return false;
    } else if(selectCategoriaForm.value == '0') {
        selectCategoriaForm.focus();
        Swal.fire('Erro!', 'Insira uma categoria válida!', 'error');
        return false;
    } else if(precoProdutoForm.value == '0' || precoProdutoForm.value.length == "") {
        precoProdutoForm.focus();
        Swal.fire('Erro!', 'Insira um preço válido!', 'error');
        return false;
    }
}

function validacaoImagem() {
    var imagemDoProdutoInput =
        document.getElementById('imagemProduto');

    var caminhoImagem = imagemDoProdutoInput.value;

    // Allowing file type
    var tiposDeImagensPermitidas =
        /(\.jpg|\.jpeg|\.png|\.gif)$/i;

    if (!tiposDeImagensPermitidas.exec(caminhoImagem)) {
        alert('Tipo de arquivo inválido');
        imagemDoProdutoInput.value = '';
        return false;
    } else {

        // Image preview
        if (imagemDoProdutoInput.files && imagemDoProdutoInput.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById(
                        'mostrarImagem').innerHTML =
                    '<img src="' + e.target.result +
                    '"/>';
            };

            reader.readAsDataURL(imagemDoProdutoInput.files[0]);
        }
    }
}

function verificaGerenciar() {
    var cpfForm = document.getElementById("cpf")

}