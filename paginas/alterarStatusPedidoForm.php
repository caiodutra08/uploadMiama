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
        <title>Alterar Status do Pedido - ADMIN</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="icon" href="../img/zangoose.png">
        <link rel="stylesheet" href="../css/clientes.css">
        <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.css">
        <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
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
            <a href="logoff.php" id="sair" class="menu" onclick="verificarSaidaCliente()">Sair</a>
            <img src="../img/5402435_account_profile_user_avatar_man_icon.svg" id="user">
        </header>

        <section id="conteudoPrincipal">
            <h1>Alterar statuds do pedido</h1>

            <?php

                require_once("conexaoBanco.php");
                $idPedido = $_POST['idPedido'];
                $nomeCliente = $_POST['nomeCliente'];
                $dataPedido = $_POST['dataPedido'];

                echo "<div id='dadosGeraisPedido'>";
                echo "<p> Nome do cliente:" . $nomeCliente . "<br>";
                echo "<p> Data do pedido:" . $dataPedido . "<br>";
                echo "<div>"
                ?>

            <form action="alterarStatusPedido.php" method="POST">

                <input type="hidden" value="<?= $idPedido ?>" name="idPedido">
                <h3>Informe o novo status do pedido</h3>

                <div id="camposAcompanhaPedido">
                    <label for="status">Status</label>
                    <select name="status" id="status">
                        <option value="1">Em aberto</option>
                        <option value="2">Em andamento</option>
                        <option value="3">Finalizado</option>
                    </select>

                    <button type="submit">Enviar alteração</button>
                </div>
            </form>
        </section>
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