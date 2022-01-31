<?php 

require_once("conexaoBanco.php");
session_start();

$dataAtual=date("Y-m-d");
$idUsuarioLogado=$_SESSION['idUsuario'];
$status=1;

$comando="INSERT INTO pedidos(data, usuarios_idUsuario, status) VALUES ('".$dataAtual."',".$idUsuarioLogado.",".$status.")";

echo $comando."<br>"; 

$resultado=mysqli_query($conexao,$comando);

$comando2="SELECT MAX(idPedido) as idPedido FROM pedidos WHERE usuarios_idUsuario = ".$idUsuarioLogado;



$resultado2=mysqli_query($conexao,$comando2);

$idPedido=mysqli_fetch_assoc($resultado2);

echo $comando2."<br>"; 

$arrayIdsProdutos=array();
$arrayIdsProdutos=$_POST['idProdutos'];

$arrayQtdesProdutos=array();
$arrayQtdesProdutos=$_POST['quantidades'];


$tamanho=sizeof($arrayIdsProdutos);
$i=0;

for($i=0;$i<$tamanho;$i++){

    $comandoFinal="INSERT INTO pedidos_has_produtos (produtos_idProduto, pedidos_idPedido, quantidade) VALUES (".$arrayIdsProdutos[$i].",". $idPedido['idPedido'].",".$arrayQtdesProdutos[$i].")";
    $resultadoFinal=mysqli_query($conexao,$comandoFinal);
    
}
echo $comandoFinal."<br>"; 

if($resultadoFinal==true) {
    header("Location: dashboardClienteMeusPedidos.php?retorno=1");
}