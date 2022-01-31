<?php

require_once("conexaoBanco.php");

$nomeCategoria = $_POST['nomeCategoria'];

$comando = "INSERT INTO categorias (nome) VALUES ('".$nomeCategoria."')";

$resultado = mysqli_query($conexao,$comando);

if ($resultado == true) {
    header("Location: dashboardAdmCadastrarCategorias.php?retorno=1");
} else {
    header("Location: dashboardAdmCadastrarCategorias.php?retorno=2");
}
?>
