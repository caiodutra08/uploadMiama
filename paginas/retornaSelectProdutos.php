<?php
require_once("conexaoBanco.php");
$comando = "SELECT * FROM produtos";
$resultado = mysqli_query($conexao, $comando);
$produtos = array();

while ($cadaProduto = mysqli_fetch_assoc($resultado)) {
    array_push($produtos, $cadaProduto);
}

$stringDeProdutos = "";

foreach ($produtos as $cadaProduto) {
    $stringDeProdutos = "<option value='" . $cadaProduto['idProduto'] . "'>" . $cadaProduto['nome'] . "</option>" . $stringDeProdutos;
}
echo $stringDeProdutos;

?>