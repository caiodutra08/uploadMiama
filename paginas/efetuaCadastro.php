<?php

require_once("conexaoBanco.php");

$nome = $_POST['nome'];
$sobrenome = $_POST['sobrenome'];
$email = $_POST['email'];
$cpf = $_POST['cpf'];
$endereco = $_POST['endereco'];
$telefone = $_POST['telefone'];
$login = $_POST['login'];
$senha = $_POST['senha'];
$senhaMD5 = md5($senha);

// echo $login."<br>".$senha."<br>".
// $email."<br>".$cpf."<br>".$endereco; 
$comando = "INSERT INTO usuarios (login, senha, permissao ) VALUES ('" . $login . "' , '" . $senhaMD5 . "' , 2)";

// echo $comando;

$resultado = mysqli_query($conexao, $comando);
$comandoMaxId = "SELECT MAX(idUsuario) as idUsuario FROM usuarios";
$resultado2 = mysqli_query($conexao, $comandoMaxId);
$idUsuario = mysqli_fetch_assoc($resultado2);

// echo $comandoMaxId;

$comando2 = "INSERT INTO clientes (nome, sobrenome,email,cpf,endereco,telefone,usuarios_idUsuario) VALUES ('" . $nome . "' , '" . $sobrenome . "','" . $email . "','" . $cpf . "','" . $endereco . "','" . $telefone . "'," . $idUsuario['idUsuario'] . ")";

$resultado3 = mysqli_query($conexao, $comando2);

if ($resultado3 == true) {
    header("Location: telaLogin.php?retorno=1");
} else {
    header("Location: telaLogin.php?retorno=2");
}
?>