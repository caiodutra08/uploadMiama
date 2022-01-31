
<?php
require_once("conexaoBanco.php");

$nomeProduto = $_POST['nomeProduto'];
$idCategoria = $_POST['selectCategoria'];
$idProduto = $_POST['idProduto'];
$precoProduto = $_POST['precoProduto'];
$imagemProduto = $_POST['imagemProduto'];

$comando = "UPDATE produtos SET nome = '" . $nomeProduto . "', categorias_idCategoria = " . $idCategoria . ", preco = " . $precoProduto . ", imagem = '" . $imagemProduto . "' WHERE idProduto = " . $idProduto;

// echo $comando;

$resultado = mysqli_query($conexao, $comando);

if ($resultado == true) {
    header("Location: dashboardAdmCadastrarProdutos.php?retorno=3");
} else {
    header("Location: dashboardAdmCadastrarProdutos.php?retorno=4");
}
?>