<?php 
require_once("conexaoBanco.php");

$nome=$_POST['nome'];
$sobrenome=$_POST['sobrenome'];
$email=$_POST['email'];
$cpf=$_POST['cpf'];
$endereco=$_POST['endereco'];
$telefone=$_POST['telefone'];
$idUsuario=$_POST['idUsuario'];

$comando = "UPDATE clientes SET nome='".$nome."', sobrenome='".$sobrenome."', email='".$email."', cpf='".$cpf."', endereco='".$endereco."', telefone='".$telefone."' WHERE usuarios_idUsuario=".$idUsuario;

$resultado= mysqli_query($conexao,$comando);

if($resultado==true){
    header("Location: dashboardClienteMeusDados.php?retorno=1");
} else {
    header("Location: dashboardClienteMeusDados.php?retorno=2");
}
?>