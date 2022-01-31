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

    <?php

    if (isset($_GET['retorno']) == true && $_GET['retorno'] == 1) {
        echo "<script>
        alert('Produto cadastrado com sucesso!');
    </script>";
    } else if (isset($_GET['retorno']) == true && $_GET['retorno'] == 2) {
        echo "<script>
        alert('Erro ao cadastrar produto!');
    </script>";
    } else if (isset($_GET['retorno']) == true && $_GET['retorno'] == 3) {
        echo "<script>
        alert('Produto alterado com sucesso!');
    </script>";
    } else if (isset($_GET['retorno']) == true && $_GET['retorno'] == 4) {
        echo "<script>
        alert('Erro ao realizar a alteração do produto!');
    </script>";
    } else if (isset($_GET['retorno']) == true && $_GET['retorno'] == 5) {
        echo "<script>
        alert('Produto excluido com sucesso!');
    </script>";
    } else if (isset($_GET['retorno']) == true && $_GET['retorno'] == 6) {
        echo "<script>
        alert('Erro ao excluir o produto!');
    </script>";
    } else if (isset($_GET['retorno']) == true && $_GET['retorno'] == 7) {
        echo "<script>
        alert('O produto não pode ser excluído pois está em algum pedido!');
    </script>";
    }

    ?>

    <body>
        <header>
            <a href="dashboardAdm.php">
                <h1 id="tituloPrincipal">Zangoose Store</h1>
            </a>
            <div class="menuNavegacao">

                <a href="dashboardAdmCadastrarCategorias.php" class="menu execp">Cadastrar Categorias</a>
                <a href="#" class="menu execp">Cadastrar produtos</a>
                <a href="dashboardAdmGerenciarPedidos.php" class="menu execp">Gerenciar pedidos</a>

            </div>

            <a href="logoff.php" id="sair" class="menu">Sair</a>
            <img src="../img/5402435_account_profile_user_avatar_man_icon.svg" id="user">


        </header>

        <section id="secaoCadastrar">

            <form action="registrarProdutos.php" method="POST">
                <h3 class="title-produtos">Dados do produto</h3>
                <label for="nomeProduto">Nome do produto:</label>
                <input type="text" class="inputADM" id="nomeProduto" name="nomeProduto" placeholder="ex.: Teclado"><br><br>
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
                    foreach ($categorias as $cadaCategoria) { ?>

                        <option value="<?= $cadaCategoria['idCategoria'] ?>">
                            <?= $cadaCategoria['nome'] ?>
                        </option>
                    <?php
                    }
                    ?>
                </select><br><br>
                <label for="precoProduto">Preço do produto:</label>
                <input type="number" class="inputADM" id="precoProduto" name="precoProduto" placeholder="ex.: 199.99"><br><br>
                <label for="imagemProduto">Envie uma imagem do produto</label>
                <input type="file" name="imagemProduto" id="imagemProduto" onchange="return validacaoImagem()" accept="image/png, image/jpeg">
                <div id="mostrarImagem"></div>

                <button type="submit" class="botoesAdm" onclick=" return verificarCadastroProduto()">Cadastrar produto</button>
            </form>
        </section>

        <br><br>

        <section id="exibicaoConsulta">
            <form action="#" method="GET">

                <div id="fff">
                    <h3 class="title-produtos">Consulta de produtos</h3><br>
                    <label for="tituloBusca">Nome do produto: </label>
                    <input type="text" name="tituloBusca" id="tituloBusca" placeholder="  ex.: Teclado Gamer">
                </div>

            </form>


            <?php

            require_once("conexaoBanco.php");
            $comando = "";

            if (isset($_GET['tituloBusca']) && $_GET['tituloBusca'] != "") {
                $busca = $_GET['tituloBusca'];
                $comando = "SELECT produtos.*, categorias.nome as nomeCategoria FROM produtos INNER JOIN categorias ON produtos.categorias_idCategoria = categorias.idCategoria WHERE produtos.nome LIKE '" . $busca . "%'";
            } else {
                $comando = "SELECT produtos.*, categorias.nome as nomeCategoria FROM produtos INNER JOIN categorias ON produtos.categorias_idCategoria = categorias.idCategoria";
            }

            $resultado = mysqli_query($conexao, $comando);
            $linhas = mysqli_num_rows($resultado);

            if ($linhas == 0) {
                echo "<script>
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: 'Não foi encontrado nenhum produto!',
                })
            </script>";
            } else {
                $produtosEncontrados = array();
                while ($cadaProduto = mysqli_fetch_assoc($resultado)) {
                    array_push($produtosEncontrados, $cadaProduto);
                }

                foreach ($produtosEncontrados as $cadaProduto) { ?>
                    <div id="divProdd">
                        <img src="../img/imagemProdutos/<?= $cadaProduto['imagem'] ?>" id="imgProd"><br>
                        <?= $cadaProduto['nome'] ?>
                        <?= $cadaProduto['nomeCategoria'] ?><br><br>
                        <p id="prreco"> <?= $cadaProduto['preco'] ?></p> <br>

                        <form action="edicaoProdutosForm.php" method="POST">
                            <input type="hidden" name="idProduto" value="<?= $cadaProduto['idProduto'] ?>">
                            <button class="inputedita" id="editaBut" type="submit">
                                Editar
                            </button>
                        </form>


                        <form action="exclusaoProduto.php" method="POST">
                            <input type="hidden" name="idProduto" value="<?= $cadaProduto['idProduto'] ?>">
                            <button class="inputedita" id="excluiBut" type="submit">
                                Excluir
                            </button>
                        </form>
                    </div>
            <?php
                }
            }

            ?>

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