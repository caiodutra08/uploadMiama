<?php

require_once("conexaoBanco.php");

$idProduto = $_POST['idProduto'];

$comando1 = "SELECT * FROM pedidos_has_produtos WHERE produtos_idProduto =" . $idProduto;

$resultado1 = mysqli_query($conexao, $comando1);

$linhas = mysqli_num_rows($resultado1);

if ($linhas == 0) {
    $comando2 = "DELETE FROM produtos WHERE idProduto =" . $idProduto;
    $resultado2 = mysqli_query($conexao, $comando2);

    if ($resultado2 == true) {
        header("Location: dashboardAdmCadastrarProdutos.php?retorno=5");
    } else {
        
        header("Location: dashboardAdmCadastrarProdutos.php?retorno=6");
    }
} else {
    header("Location: dashboardAdmCadastrarProdutos.php?retorno=7");
}
