<?php

    session_start();

    /**Destruindo variáveis de sessão */
    unset($_SESSION['idUsuario']);
    unset($_SESSION['login']);
    unset($_SESSION['senha']);
    unset($_SESSION['permissao']);

    header("Location: telaLogin.php");


?>