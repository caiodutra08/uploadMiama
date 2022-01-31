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
        <title>Editar categoria</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="icon" href="../img/zangoose.png">
        <link rel="stylesheet" href="../css/clientes.css">
        <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.css">
        <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
        <script src="../js/clientes.js"></script>
    </head>

    <body>
        <header>
            <a href="dashboardAdm.php">
                <h1 id="tituloPrincipal">Zangoose Store</h1>
            </a>
            <div class="menuNavegacao">

                <a href="#" class="menu execp">Cadastrar categorias</a>
                <a href="dashboardAdmCadastrarProdutos.php" class="menu execp">Cadastrar produtos</a>
                <a href="dashboardAdmGerenciarPedidos.php" class="menu execp">Gerenciar pedidos</a>

            </div>

            <input type="text" id="inputPesquisa">
            <button type="button" id="button"><img src="../img/3844467_magnifier_search_zoom_icon.svg" alt=""></button>
            <a href="logoff.php" id="sair" class="menu">Sair</a>
            <img src="../img/5402435_account_profile_user_avatar_man_icon.svg" id="user">


        </header>
<?php 

require_once("conexaoBanco.php");

$idCategoria = $_POST['idCategoria'];

$comando = "SELECT * FROM categorias WHERE idCategoria=".$idCategoria;

$resultado = mysqli_query($conexao,$comando);

$categoriaRetornada = mysqli_fetch_assoc($resultado);

?>
        <section id="secaoEditarCategoria">

            <form action="efetuaAlteracaoCategoria.php" method="POST">
            <input type="hidden" name="idCategoria" value="<?=$categoriaRetornada['idCategoria']?>">
                <label for="nomeCategoria">Nome da categoria:</label>
                <input type="text" class="inputADM" id="nomeCategoria" name="nomeCategoria" value="<?=$categoriaRetornada['nome']?>">
                <button type="submit" class="botoesAdm" onclick=" return verificarCadastroCategoria()">Editar categoria</button>
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