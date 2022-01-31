<?php
$localBanco = "localhost";
$usuario = "root";
$senha = "";
$nomeBanco = "lojaonline";

$conexao = mysqli_connect($localBanco, $usuario, $senha, $nomeBanco);

$conexao->set_charset("utf8");
?>