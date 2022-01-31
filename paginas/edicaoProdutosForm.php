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
        <title>Cadastrar Produtos</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="icon" href="../img/zangoose.png">
        <link rel="stylesheet" href="../css/clientes.css">
        <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.css">
        <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
        <script src="../js/administrador.js"></script>
    </head>

    <body>
        <header>
            <a href="dashboardAdm.php">
                <h1 id="tituloPrincipal">Zangoose Store</h1>
            </a>
            <div class="menuNavegacao">

                <a href="dashboardAdmCadastrarCategorias.php" class="menu execp">Cadastrar produtos</a>
                <a href="#" class="menu execp">Cadastrar produtos</a>
                <a href="dashboardAdmGerenciarPedidos.php" class="menu execp">Gerenciar pedidos</a>

            </div>

            <a href="logoff.php" id="sair" class="menu">Sair</a>
            <img src="../img/5402435_account_profile_user_avatar_man_icon.svg" id="user">


        </header>

        <?php require_once("conexaoBanco.php");
        $idProduto = $_POST['idProduto'];

        $comando = "SELECT * FROM produtos WHERE idProduto = " . $idProduto;

        $resultado = mysqli_query($conexao, $comando);

        $produtoRetornado = mysqli_fetch_assoc($resultado);
        ?>

        <section id="secaoCadastrar">

            <form action="efetuaAlteracaoProdutos.php" method="POST">
                <input type="hidden" name="idProduto" value="<?=$produtoRetornado['idProduto']?>">
                <h3>Dados do produto</h3>
                <label for="nomeProduto">Nome do produto:</label>
                <input type="text" class="inputADM" id="nomeProduto" name="nomeProduto" placeholder="ex.: Teclado" value="<?= $produtoRetornado['nome'] ?>">
                <label for="selectCategoria">Selecione a categoria:</label>
                <select name="selectCategoria" id="selectCategoria">
                    <option value="0">Selecione...</option>
                    <?php
                    require_once("conexaoBanco.php");

                    $comando = "SELECT * FROM categorias";

                    $resultado = mysqli_query($conexao, $comando);

                    $categorias = array();
                    while ($cadaCategoria = mysqli_fetch_assoc($resultado)) {
                        array_push($categorias, $cadaCategoria);
                    }
                    foreach ($categorias as $cadaCategoria) {
                        if ($cadaCategoria['idCategoria'] == $produtoRetornado['categorias_idCategoria']) {

                    ?>

                            <option selected value="<?= $cadaCategoria['idCategoria'] ?>">
                                <?= $cadaCategoria['nome'] ?>
                            </option>
                        <?php
                        } else {
                        ?>
                            <option value="<?= $cadaCategoria['idCategoria'] ?>">
                                <?= $cadaCategoria['nome'] ?>
                            </option>
                    <?php
                        }
                    }
                    ?>
                </select>
                <label for="precoProduto">Preço do produto:</label>
                <input type="number" class="inputADM" id="precoProduto" name="precoProduto" placeholder="ex.: 199.99" value="<?= $produtoRetornado['preco'] ?>">
                <label for="imagemProduto">Envie uma imagem do produto</label>
                <input type="file" name="imagemProduto" id="imagemProduto">

                <button type="submit" class="botoesAdm" onclick=" return verificarCadastroProduto()">Alterar produto</button>
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