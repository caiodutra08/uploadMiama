<?php
session_start();
if (isset($_SESSION['idUsuario']) == true && $_SESSION['permissao'] == 2) {
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Efetuar Compra - <?= $_SESSION['nome'] ?></title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="../js/clientes.js"></script>
        <link rel="icon" href="../img/zangoose.png">
        <link rel="stylesheet" href="../css/clientes.css">
        <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.css">
        <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="../js/funcoesPedidoProdutos.js"></script>
        <link rel="stylesheet" href="../css/efetuar.css">
    </head>


    <body id="body">
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

        $nomeSobrenome = $_SESSION['nome'] . " " . $_SESSION['sobrenome'];

        $idProdutoQuerComprar = $_POST['idProdutoQuerComprar'];
        $precoProdutoQuerComprar = $_POST['precoProdutoQuerComprar'];
        $imagemProdutoQuerComprar = $_POST['imagemProdutoQuerComprar'];
        $nomeProdutoQuerComprar = $_POST['nomeProdutoQuerComprar'];


        ?>

        <section id="conteudoPrincipal">
            <h3 id="title">Novo pedido</h3>

            <label for="nomeUser" id="name">Nome</label>
            <input type="text" name="nomeUser" id="nomeUser" value="<?= $nomeSobrenome ?>" disabled="disabled">

            <?php $dataAtual = date("Y-m-d"); ?>

            <label for="data">Data</label>
            <input type="date" name="data" id="data" value="<?= $dataAtual ?>" disabled="disabled">

            <label for="valorTotal">Valor total</label>
            <input type="text" name="valorTotal" id="valorTotal" value="0" disabled="disabled">
        </section>
        <br>

        <form action="registraPedidos.php" method="POST">
            <h3 id="deseja">Selecione os produtos que deseja comprar</h3><br>
            <div id="produto0">
                <div class="didi">
                    <img class="imgimg" src="../img/imagemProdutos/<?= $imagemProdutoQuerComprar ?>" id="idImagemProduto0" alt="<?= $nomeProdutoQuerComprar ?>">

                    <label class="nomeProduto" name="nomeProdutosQuerComprar" id="nomeProdutosQuerComprar"><?= $nomeProdutoQuerComprar ?></label>

                    <input type="hidden" name="idProdutos[]" id="idProdutos0" value="<?= $idProdutoQuerComprar ?>">

                    <div class="menuuu">
                        <label class="labi" for="valorUnitario0">R$</label>
                        <input type="text" name="valorUnitarioQuerComprar" disabled="disabled" id="valorUnitario0" class="valorUnitario0" value="<?= $precoProdutoQuerComprar ?>">

                        <label for="quantidade0" class="label">Quantidade</label>
                        <input type="number" name="quantidades[]" id="quantidade0" onblur="atualizaValorTotal(this.value,0)" value="0">

                        <button type="button" onclick="adicionaProduto()">+</button>
                    </div>
                    <br>

                </div>

                <div class="menu"> 
                <div class="didi" id="maisProdutos"></div>


                <button type="reset" onclick="resetaFormPedidos()" id="limpar">Limpar</button>
                <button type="submit" id="enviar">Enviar</button>
                </div>
        </form>
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