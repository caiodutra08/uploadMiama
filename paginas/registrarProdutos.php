<?php 

require_once("conexaoBanco.php");

$nomeProduto = $_POST['nomeProduto'];
$selectCategoria = $_POST['selectCategoria'];
$precoProduto = $_POST['precoProduto'];
$imagemProduto = $_POST['imagemProduto'];

$comando="INSERT INTO produtos (nome, preco, categorias_idCategoria, imagem) VALUES ('".$nomeProduto."', ".$precoProduto.", ".$selectCategoria.", '".$imagemProduto."')";

// echo $comando;

$resultado = mysqli_query($conexao, $comando);

if($resultado==true) {
    echo '<pre>';
    header("Location: dashboardAdmCadastrarProdutos.php?retorno=1");
} else {
    header("Location: dashboardAdmCadastrarProdutos.php?retorno=2");
}

?>