<?php
session_start();
if (
    isset($_SESSION['idUsuario']) == true && $_SESSION['permissao'] == 2
) {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Meus dados - <?=$_SESSION['nome']?></title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="../js/clientes.js"></script>
        <link rel="icon" href="../img/zangoose.png">
        <link rel="stylesheet" href="../css/clientes.css">
        <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.css">
        <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
        <link rel="stylesheet" href="../css/meusDados.css">
    </head>
    <?php
    if (isset($_GET['retorno']) == true && $_GET['retorno'] == 1) {
        echo "<script> 
         alert('Alteração realizada com sucesso!');
    </script>";
    } else if (isset($_GET['retorno']) == true && $_GET['retorno'] == 2) {
        echo "<script> 
         alert('Não foi possivel realizar a alteração!');
    </script>";
    }
    ?>
    <body>
        <header>
            <a href=dashboardCliente.php>
                <h1 id="tituloPrincipal">Zangoose Store</h1>
            </a>
            <div class="menuNavegacao">
                <a href="dashboardClienteProdutos.php" class="menu execp">Produtos</a>
                <a href="dashboardClienteMeusPedidos.php" class="menu execp">Acompanhar meus pedidos</a>
                <a href="#" class="menu execp">Meus Dados</a>

            </div>

            <a href="logoff.php" id="entrar" class="menu">Sair</a>
            <img src="../img/5402435_account_profile_user_avatar_man_icon.svg" id="user">


        </header>

        <?php

            require_once("conexaoBanco.php");

            $idUsuario = $_SESSION['idUsuario'];

            $comando = "SELECT clientes.*, usuarios.idUsuario FROM clientes INNER JOIN usuarios ON clientes.usuarios_idUsuario=usuarios.idUsuario WHERE usuarios.idUsuario=".$idUsuario;

            $resultado = mysqli_query($conexao, $comando);

            $usuarioRetornado = mysqli_fetch_assoc($resultado);

            ?>

        <img src="../img/ZangooseLogin.png" id="loginLogo" alt="">

        <div id="conteudoPrincipalMeusDados">
            <div id="div1">
                <section id="alterarDados">
                    <h1 id="meusDadosTitulo">Alterar meus dados:</h1>
                    <form action="efetuaAlteracaoMeusDados.php" method="POST">
                        <input type="hidden" name="idUsuario" value="<?=$usuarioRetornado['idUsuario'] ?>" class="inputss"> <br>
                        <h2 class="h2o">Nome:</h2> <input type="text" id="nome" name="nome" placeholder="Nome:" value="<?=$usuarioRetornado['nome']?>" class="inputss"> <br>
                        <h2 class="h2o">Sobrenome</h2> <input type="text" id="sobrenome" name="sobrenome" placeholder="Sobrenome:" value="<?=$usuarioRetornado['sobrenome']?>" class="inputss"> <br>
                        <h2 class="h2o">Email:</h2> <input type="text" id="email" name="email" placeholder="Email:" value="<?=$usuarioRetornado['email']?>" class="inputss"> <br>
                        <h2 class="h2o">CPF:</h2> <input type="text" id="cpf" name="cpf" placeholder="CPF:" value="<?=$usuarioRetornado['cpf']?>" class="inputss"> <br>
                        <h2 class="h2o">Endereço:</h2> <input type="text" id="endereco" name="endereco" placeholder="Endereço:" value="<?=$usuarioRetornado['endereco']?>" class="inputss"> <br> 
                        <h2 class="h2o">Telefone:</h2> <input type="text" id="telefone" name="telefone" placeholder="Telefone:" value="<?=$usuarioRetornado['telefone']?>" class="inputss"> <br> 

                        <button id="alterar" onclick="return verificarAlteracao()">Alterar</button>

                    </form>

                </section>


            </div>



    </body>

    </html>
<?php

} else if (
    isset($_SESSION['idUsuario']) == true &&
    $_SESSION['permissao'] == 1
) {
    header("Location: semPermissao.php");
} else if (isset($_SESSION['idUsuario']) == false) {
    header("Location: facaLogin.php");
}


?>