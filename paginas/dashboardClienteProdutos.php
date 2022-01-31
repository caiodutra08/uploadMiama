<?php
session_start();
if (isset($_SESSION['idUsuario']) == true && $_SESSION['permissao'] == 2) {
?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Produtos - <?= $_SESSION['nome'] ?></title>
        <link rel="stylesheet" href="../css/cssProdutos.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="icon" href="../img/zangoose.png">
        <link rel="stylesheet" href="../css/clientes.css">
        <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.css">
        <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    </head>
    <?php
    if (isset($_GET['retorno']) == true && $_GET['retorno'] == 1) {
        echo "<script> 
         alert('Pedido realizado com sucesso!');
    </script>";
    }
    ?>

    <body>
        <header>
            <a href="dashboardCliente.php">
                <h1 id="tituloPrincipal">Zangoose Store</h1>
            </a>
            <div class="menuNavegacao">
                <a href="#" class="menu execp">Produtos</a>
                <a href="dashboardClienteMeusPedidos.php" class="menu execp">Acompanhar meus pedidos</a>
                <a href="dashboardClienteMeusDados.php" class="menu execp">Meus Dados</a>

            </div>
            <form action="#" method="GET">

            <button type="submit" id="button">
                <img src="../img/3844467_magnifier_search_zoom_icon.svg" alt="">
            </button>
            <input type="text" id="inputPesquisa" name="inputPesquisa">

        </form>
            <a href="logoff.php" id="sair" class="menu">Sair</a>
            <img src="../img/5402435_account_profile_user_avatar_man_icon.svg" id="user">
        </header>

        <div id="conteudoPrincipalProdutos">
            <div id="filtros">
                <img src="../img/ZangooseLogin.png" alt="" id="logozada">
                <form action="#" method="POST">

                    <p class="filtros">Gamer</p>
                    <input type="checkbox" class="gamer" name="gamer"> Periféricos<br>
                    <input type="checkbox" class="gamer" name="gamer"> Mesas<br>
                    <input type="checkbox" class="gamer" name="gamer"> Computadores<br>
                    <input type="checkbox" class="gamer" name="gamer"> Monitores<br>

                    <p class="filtros">Marcas</p>

                    <input type="checkbox" class="marcas"> Razer<br>
                    <input type="checkbox" class="marcas"> Corser<br>
                    <input type="checkbox" class="marcas"> Pichau<br>
                    <input type="checkbox" class="marcas"> Logithec<br>

                    <p class="filtros">Estilo</p>
                    <input type="checkbox" class="RGB"> RGB<br>
                    <p class="filtros">Layout </p>
                    <input type="checkbox" class="layout"> Linear<br>
                    <input type="checkbox" class="layout"> Funcional<br>
                    <input type="checkbox" class="layout"> Posicional<br>

                </form>
            </div>
            <div id="produtosDiv">

                <?php
                require_once("conexaoBanco.php");
                $comando = "";

                if (isset($_GET['inputPesquisa']) && $_GET['inputPesquisa'] != "") {
                    $nomeProduto = $_GET['inputPesquisa'];
                    $comando = "SELECT * FROM produtos WHERE nome LIKE '%" . $nomeProduto . "%'";
                    // echo $comando;
                } else {
                    $comando = "SELECT * FROM produtos";
                }

                $resultado = mysqli_query($conexao, $comando);
                $linhas = mysqli_num_rows($resultado);

                if ($linhas == 0) { ?>

                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Não foi encontrado nenhum produto!',
                        })
                    </script>
                    <?php
                } else {
                    $arrayProdutos = array();
                    while ($cadaProduto = mysqli_fetch_assoc($resultado)) {
                        array_push($arrayProdutos, $cadaProduto);
                    }
                    foreach ($arrayProdutos as $cadaProduto) { ?>
                        <div class="divProdutoOrg">
                            <input type="hidden" name="idProduto" value="<?= $cadaProduto['idProduto'] ?>">
                            <img src="../img/imagemProdutos/<?= $cadaProduto['imagem'] ?>" id="teclado1" alt="">
                            <p><?= $cadaProduto['nome'] ?></p>
                            <p id="precoExibido"><?= $cadaProduto['preco'] ?></p>

                            <form action="dashboardClienteEfetuarCompraProduto.php" method="POST">
                                <input type="hidden" value="<?= $cadaProduto['idProduto'] ?>" name="idProdutoQuerComprar">
                                <input type="hidden" value="<?= $cadaProduto['preco'] ?>" name="precoProdutoQuerComprar">
                                <input type="hidden" value="<?= $cadaProduto['nome'] ?>" name="nomeProdutoQuerComprar">
                                <input type="hidden" value="<?= $cadaProduto['imagem'] ?>" name="imagemProdutoQuerComprar">
                                <button id="buttonComprar" type="submit">Comprar</button>
                                <p id="desconto">no boleto ou PIX com 12% desconto</p>
                            </form>

                        </div>
                <?php
                    }
                }
                ?>
            </div>
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