﻿var cont = 1;
var todosOsProdutos = "";
var valoresJaAdicionadosAoTotal = [];

$.ajax({
    type: "POST",
    url: "retornaSelectProdutos.php",
    success: function (produtos) {
        todosOsProdutos = produtos
    }
});

function adicionaProduto() {
    var novaDivProduto = "";

    novaDivProduto =
        "<div id='produto" + cont + "'>" +
        "<br>" +
        "<img class='imgimg' id='img" + cont + "'>" +
        "<label class='nomeProduto' for='idProduto" + cont + "'>Produto</label>" +
        "<select name='idProdutos[]' id='idProduto" + cont + "' class='camposForm' " +
        "onchange='retornaValorUnitario(this.value, " + cont + ")'>" +
        "<option value='0'> Selecione...</option>" + todosOsProdutos +
        "</select>" +
        "<label for='valorUnitario" + cont + "' class='labi'>R$</label>" +
        "<input type='text' name='valoresUnitarios[]' disabled='disabled' id='valorUnitario" + cont + "'" +
        "class='camposForm'>" +
        "<label for='quantidade" + cont + "' class='label'>Quantidade</label>" +
        "<input type='number' name='quantidades[]' onblur='atualizaValorTotal(this.value," + cont + ")' " +
        "id='quantidade" + cont + "' class='camposForm'>" +
        "<button type='button' onclick='removeProduto(" + cont + ")'>-</button>" +
        "<button type='button' onclick='adicionaProduto()'>+</button>" +
        "</div>";

    $("#maisProdutos").append(novaDivProduto);

    cont += 1
}

function retornaImagemProduto(idProduto, valorCont) {
    if (idProduto != 0)
        $.ajax({
            type: "POST",
            data: {
                idProduto: idProduto
            },
            url: "retornaImagemProduto.php",
            success: function (imagemProduto) {
                document.getElementById(`img${valorCont}`).setAttribute('src', `../img/imagemProdutos/${imagemProduto}`);
            }
        });
}

function retornaValorUnitario(idProduto, valorCont) {
    if (idProduto != 0)
        $.ajax({
            type: "POST",
            data: {
                idProduto: idProduto
            },
            url: "retornaPrecoUnitarioProduto.php",
            success: function (precoProduto) {
                $(`#valorUnitario${valorCont}`).val(precoProduto);
                retornaImagemProduto(idProduto, valorCont);
            }
        });
}

function atualizaValorTotal(qtde, valorCont) {

    var preco = parseFloat($(`#valorUnitario${valorCont}`).val());
    var qtde = parseFloat($(`#quantidade${valorCont}`).val());
    var totalPorProduto = preco * qtde;
    var valorFinalTotal = 0;

    var valorTotalAtual = parseFloat($(`#valorTotal`).val());

    var inputValorTotal = $(`#valorTotal`);

    if (valoresJaAdicionadosAoTotal[valorCont] == null) {
        valorFinalTotal = valorTotalAtual + totalPorProduto;
        valorFinalTotal = valorFinalTotal.toFixed(2);
        inputValorTotal.val(valorFinalTotal);
    } else {
        valorFinalTotal = valorTotalAtual - parseFloat(valoresJaAdicionadosAoTotal[valorCont]) + totalPorProduto;
        valorFinalTotal = valorFinalTotal.toFixed(2);
        inputValorTotal.val(valorFinalTotal);
    }
    valoresJaAdicionadosAoTotal[valorCont] = totalPorProduto;
}

function removeProduto(valorCont) {
    var valorFinalTotal = 0;

    var valorTotalAtual = parseFloat($("#valorTotal").val());

    var inputValorTotal = $("#valorTotal");
    if (valoresJaAdicionadosAoTotal[valorCont] != null) {
        valorFinalTotal = valorTotalAtual - parseFloat(valoresJaAdicionadosAoTotal[valorCont]);
        valorFinalTotal = valorFinalTotal.toFixed(2);
        inputValorTotal.val(valorFinalTotal);
    }
    $(`#produto${valorCont}`).remove();
}

function resetaFormPedido() {
    $divMaisProdutos = $("#maisProdutos").empty();
    $("valorTotal").val("0");
    valoresJaAdicionadosAoTotal = [];
}