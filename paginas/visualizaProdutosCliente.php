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
        <title>Visalizar produtos do pedido - <?= $_SESSION['nome'] ?></title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="../js/clientes.js"></script>
        <link rel="icon" href="../img/zangoose.png">
        <link rel="stylesheet" href="../css/clientes.css">
        <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.css">
        <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
        <link rel="stylesheet" href="../css/visualiza.css">
    </head>

    <body>
        <header>
            <a href=dashboardCliente.php>
                <h1 id="tituloPrincipal">Zangoose Store</h1>
            </a>
            <div class="menuNavegacao">
                <a href="dashboardClienteProdutos.php" class="menu execp">Produtos</a>
                <a href="#" class="menu execp">Acompanhar meus pedidos</a>
                <a href="dashboardClienteMeusDados.php" class="menu execp">Meus Dados</a>

            </div>

            <a href="logoff.php" id="entrar" class="menu">Sair</a>
            <img src="../img/5402435_account_profile_user_avatar_man_icon.svg" id="user">


        </header>

        <section id="conteudoPrincipal">
            <h3 id="title">Produtos do pedido:</h3>
            <?php

                require_once("conexaoBanco.php");
                $idPedido = $_POST['idPedido'];
                $comando = "SELECT produtos.nome, produtos.preco, produtos.imagem FROM produtos INNER JOIN pedidos_has_produtos ON produtos.idProduto=pedidos_has_produtos.produtos_idProduto WHERE pedidos_has_produtos.pedidos_idPedido=" . $idPedido;
                $resultado = mysqli_query($conexao, $comando);
                $produtosDoPedido = array();
                while ($cadaProduto = mysqli_fetch_assoc($resultado)) {
                    array_push($produtosDoPedido, $cadaProduto);
                }
                foreach ($produtosDoPedido as $cadaProduto) {
                    echo "<img src='../img/imagemProdutos/" . $cadaProduto['imagem']."' id='imagem'> <p class='produtosListados'>Nome do produto: " . $cadaProduto['nome'] . "</p>
                <p class='produtosListados'>Preço do produto: R$" . $cadaProduto['preco'] . "</p><br>";
                }
                ?>
        </section>
        <a href="dashboardClienteMeusPedidos.php" ><button id="button">Voltar</button></a>
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