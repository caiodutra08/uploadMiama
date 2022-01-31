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
        <title>Visualizar produtos do pedido - ADMIN</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="icon" href="../img/zangoose.png">
        <link rel="stylesheet" href="../css/clientes.css">
        <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.css">
        <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
        <link rel="stylesheet" href="../css/visualiza.css">
        <script src="../js/administrador.js"></script>
    </head>

    <body>
        <header>
            <a href="#">
                <h1 id="tituloPrincipal">Zangoose Store</h1>
            </a>
            <div class="menuNavegacao">

                <a href="dashboardAdmCadastrarCategorias.php" class="menu execp">Cadastrar categorias</a>
                <a href="dashboardAdmCadastrarProdutos.php" class="menu execp">Cadastrar produtos</a>
                <a href="dashboardAdmGerenciarPedidos.php" class="menu execp">Gerenciar pedidos</a>
            </div>
            <a href="logoff.php" id="sair" class="menu">Sair</a>
            <img src="../img/5402435_account_profile_user_avatar_man_icon.svg" id="user">
        </header>

        <section id="conteudoPrincipal">
            <h1>Produtos do pedido</h1>

            <?php

                require_once("conexaoBanco.php");
                $idPedido = $_POST['idPedido'];
                $comando = "SELECT produtos.nome, produtos.preco, produtos.imagem FROM produtos INNER JOIN pedidos_has_produtos ON produtos.idProduto = pedidos_has_produtos.produtos_idProduto WHERE pedidos_has_produtos.pedidos_idPedido=" . $idPedido;

                $resultado = mysqli_query($conexao, $comando);
                $produtosDoPedido = array();
                while ($cadaProduto = mysqli_fetch_assoc($resultado)) {
                    array_push($produtosDoPedido, $cadaProduto);
                }

                foreach ($produtosDoPedido as $cadaProduto) {
                    echo "<img src='../img/imagemProdutos/".$cadaProduto['imagem']."' id='imagem'> <p class='produtosListados'>Nome do produto: " . $cadaProduto['nome'] . "</p> <p class='produtosListados'> Preço: " . $cadaProduto['preco'] . " </p><br>";
                }

                ?>
        </section>
        <a href="dashboardAdmGerenciarPedidos.php">
            <button id="buttonAdm">Voltar para Gerenciar Pedidos</button>
        </a>
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