<?php

require_once("conexaoBanco.php");

$idProduto = $_POST['idProduto'];

$comando = "SELECT preco FROM produtos WHERE idProduto=" . $idProduto;

$resultado = mysqli_query($conexao, $comando);

$idRecebido = mysqli_fetch_assoc($resultado);

echo $idRecebido['preco'];
?>