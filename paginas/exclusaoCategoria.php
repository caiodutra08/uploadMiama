<?php

require_once("conexaoBanco.php");

$idCategoria = $_POST['idCategoria'];

$comando1 = "SELECT idProduto FROM produtos WHERE categorias_idCategoria=" . $idCategoria;

$resultado1 = mysqli_query($conexao, $comando1);

$linhas = mysqli_num_rows($resultado1);

if ($linhas == 0) {
    $comando2 = "DELETE FROM categorias WHERE idCategoria=" . $idCategoria;
    $resultado2 = mysqli_query($conexao, $comando2);

    if ($resultado2 == true) {
        header("Location: dashboardAdmCadastrarCategorias.php?retorno=3");
    } else {
        
        header("Location: dashboardAdmCadastrarCategorias.php?retorno=4");
    }
} else {
    header("Location: dashboardAdmCadastrarCategorias.php?retorno=5");
}
