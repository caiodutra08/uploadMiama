<?php 
require_once("conexaoBanco.php");

$nomeCategoria=$_POST['nomeCategoria'];
$idCategoria=$_POST['idCategoria'];


$comando = "UPDATE categorias SET nome = '".$nomeCategoria."' WHERE idCategoria = ".$idCategoria;
// echo $comando;
$resultado= mysqli_query($conexao,$comando);

if($resultado==true){
    header("Location: dashboardAdmCadastrarCategorias.php?retorno=6");
} else {
    header("Location: dashboardAdmCadastrarCategorias.php?retorno=7");
}
?>