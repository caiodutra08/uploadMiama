<?php

session_start();

if (isset($_SESSION['idUsuario']) == true) {
    if ($_SESSION['permissao'] == 1) {
        header("Location: dashboardAdm.php");
    } else if ($_SESSION['permissao'] == 2) {
        header("Location: dashboardCliente.php");
    }
} else { //fechamento do else no final da página
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link rel="stylesheet" href="../css/cssLogin.css">
        <link rel="stylesheet" href="../css/index.css">
        <link rel="icon" href="../img/zangoose.png">
        <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.css">
        <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
        <script src="../js/telaLogin.js"></script>
        <script src="../js/index.js"></script>
    </head>
    <?php
        if (isset($_GET['retorno']) == true && $_GET['retorno'] == 1) {
            echo "<script> 
         alert('Cadastro realizado com sucesso!');
    </script>
    ";
        } else if (isset($_GET['retorno']) == true && $_GET['retorno'] == 2) {
            echo "<script> 
         alert('Não foi possivel realizar o cadastro!');
    </script>
    ";
        } else if (isset($_GET['retorno']) == true && $_GET['retorno'] == 3) {
            echo "<script> 
         alert('Não foi possivel realizar o login!');
    </script>
    ";
        }

        ?>

    <body onload="onload()">
        <header>

            <a href="../index.php">
                <h1 id="tituloPrincipal">Zangoose Store</h1>
            </a>
            <img src="../img/ZangooseLogin.png" id="loginLogo" alt="">
        </header>

        <section id="mainLogin">
            <h1 id="loginTitle">Login</h1>
            <form action="efetuaLogin.php" method="POST">
                <input type="text" id="login" name="login" placeholder="Usuário:"><br>
                <input type="password" id="senha" name="senha" placeholder="Senha:"><br>

                <button onclick="return verificarLogin()" type="submit" id="logar">Logar</button>
            </form>

        </section>
        <a href="cadastrar.php"><button id="cadastrar">Cadastrar</button></a>
    </body>

    </html>
<?php
}
?>