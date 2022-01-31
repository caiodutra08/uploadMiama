<?php
require_once("conexaoBanco.php");

$login = $_POST['login'];
$senha = $_POST['senha'];
$senhaMD5 = md5($senha);

$comando = "SELECT * FROM  usuarios WHERE login = '" . $login . "' AND senha='" . $senhaMD5 . "'";


$resultado = mysqli_query($conexao, $comando);
$linhas = mysqli_num_rows($resultado);

if ($linhas == 0) {
    header("Location: telaLogin.php?retorno=3");
} else {
    $usuarioRetornado = mysqli_fetch_assoc($resultado);
    session_start();
    $_SESSION['idUsuario'] = $usuarioRetornado['idUsuario'];
    $_SESSION['login'] = $usuarioRetornado['login'];
    $_SESSION['senha'] = $usuarioRetornado['senha'];
    $_SESSION['permissao'] = $usuarioRetornado['permissao'];

    if ($usuarioRetornado['permissao'] == 1) {
        $comando3 = "SELECT nome, sobrenome FROM clientes WHERE usuarios_idUsuario=" . $_SESSION['idUsuario'];
        $resultado3 = mysqli_query($conexao, $comando3);
        $clienteRetornado2 = mysqli_fetch_assoc($resultado3);
        $_SESSION['nome'] = $clienteRetornado2['nome'];
        $_SESSION['sobrenome'] = $clienteRetornado2['sobrenome'];
        header("Location: dashboardAdm.php");
    } else if ($usuarioRetornado['permissao'] == 2) {
        $comando2 = "SELECT nome, sobrenome FROM clientes WHERE usuarios_idUsuario=" . $_SESSION['idUsuario'];
        $resultado2 = mysqli_query($conexao, $comando2);
        $clienteRetornado = mysqli_fetch_assoc($resultado2);
        $_SESSION['nome'] = $clienteRetornado['nome'];
        $_SESSION['sobrenome'] = $clienteRetornado['sobrenome'];
        header("Location: dashboardCliente.php");
    }
}
