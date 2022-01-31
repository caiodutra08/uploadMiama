<?php
session_start();
if (
    isset($_SESSION['idUsuario']) == true && $_SESSION['permissao'] == 1
) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Zangoose Store - ADMIN</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="icon" href="../img/zangoose.png">
        <link rel="stylesheet" href="../css/clientes.css">
        <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.css">
        <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
        <script src="../js/administrador.js"></script>
        <script>
            function mostrarAnimacao() {
                const Toast = Swal.mixin({
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 2700,
                    timerProgressBar: true,
                    didOpen: (toast) => {
                        toast.addEventListener('mouseenter', Swal.stopTimer)
                        toast.addEventListener('mouseleave', Swal.resumeTimer)
                    }
                })

                Toast.fire({
                    icon: 'success',
                    title: "Bem vindo administrador!"
                })
            }
        </script>
    </head>

    <body onload="mostrarAnimacao()">
        <header>
            <a href="#">
                <h1 id="tituloPrincipal">Zangoose Store</h1>
            </a>
            <div class="menuNavegacao">

                <a href="dashboardAdmCadastrarCategorias.php" class="menu execp">Cadastrar categorias</a>
                <a href="dashboardAdmCadastrarProdutos.php" class="menu execp">Cadastrar produtos</a>
                <a href="dashboardAdmGerenciarPedidos.php" class="menu execp">Gerenciar pedidos</a>

            </div>

        
            <a href="logoff.php" id="sair" class="menu" onclick="verificarSaidaCliente()">Sair</a>
            <img src="../img/5402435_account_profile_user_avatar_man_icon.svg" id="user">


        </header>




        <div id="slider">
            <figure>

                <img class="imgSlider" src="../img/pcGamer1.jpg">
                <img class="imgSlider" src="../img/pcGamer2.jpg">
                <img class="imgSlider" src="../img/pcGamer3.jpg">

            </figure>
        </div>


        <div id="exibeProdutos">

            <div id="divBotoes">

                <button class="botao" id="botao1" type="button"> <img src="../img/pcPromo.png" id="mouseBotao">
                    <h2>Gamer</h2> <br> O melhor para você
                </button>
                <button class="botao" id="botao2" type="button"> <img src="../img/mouse.png" id="mouseBotao">
                    <h2>Versatil</h2> <br>Encaixe perfeito
                </button>
                <button class="botao" id="botao3" type="button"> <img src="../img/tecladoo.png" id="mouseBotao">
                    <h2>Conforto</h2> <br>Durabilidade
                </button>
                <button class="botao" id="botao4" type="button"> <img src="../img/headset.png" id="mouseBotao">
                    <h2>Equilibrio</h2> <br>Realidade sonora
                </button>
            </div>
        </div>

    </body>

    </html>
<?php

} else if (
    isset($_SESSION['idUsuario']) == true &&
    $_SESSION['permissao'] == 2
) {
    header("Location: semPermissao.php");
} else if (isset($_SESSION['idUsuario']) == false) {
    header("Location: facaLogin.php");
}


?>