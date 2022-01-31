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
        <title>Zangoose Store</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="icon" href="../img/zangoose.png">
        <link rel="stylesheet" href="../css/admin.css">
        <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.css">
        <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
        <script src="../js/administrador.js"></script>
    </head>

    <?php
    if (isset($_GET['retorno']) == true && $_GET['retorno'] == 1) {
        echo "<script> 
             alert('Cadastro de categoria realizado com sucesso!');
        </script>";
    } else if (isset($_GET['retorno']) == true && $_GET['retorno'] == 2) {
        echo "<script>
            alert('Não foi possível cadastrar a categoria!');
        </script>";
    } else if (isset($_GET['retorno']) == true && $_GET['retorno'] == 3) {
        echo "<script>
            alert('Categoria removida com sucesso!');
        </script>";
    } else if (isset($_GET['retorno']) == true && $_GET['retorno'] == 4) {
        echo "<script>
            alert('Erro ao remover a categoria!');
        </script>";
    } else if (isset($_GET['retorno']) == true && $_GET['retorno'] == 5) {
        echo "<script>
            alert('A categoria possui produtos, não pode ser removida!');
        </script>";
    } else if (isset($_GET['retorno']) == true && $_GET['retorno'] == 6) {
        echo "<script>
            alert('Edição concluida com sucesso!');
        </script>";
    } else if (isset($_GET['retorno']) == true && $_GET['retorno'] == 7) {
        echo "<script>
            alert('Não foi possível editar a categoria!');
        </script>";
    }
    ?>

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

            
            <a href="logoff.php" id="sair" class="menu">Sair</a>
            <img src="../img/5402435_account_profile_user_avatar_man_icon.svg" id="user">


        </header>
        <br>

        <section id="secaoCadastrar">

            <form action="registrarCategorias.php" method="POST">
                <div class="secaoCategoria">
                <label for="nomeCategoria">Cadastrar o nome da categoria:</label>
                <input type="text" class="inputADM" id="nomeCategoria" name="nomeCategoria" placeholder="ex.:Teclado">
                <button type="submit" class="botoesAdm" onclick=" return verificarCadastroCategoria()">Cadastrar categoria</button>
                </div>
            </form>
        </section>

        <section id="secaoConsulta">
          
            <form action="#" method="GET">
            <div class="secaoCategoria">
                <label for="categoriaBusca">Pesquisar o nome da categoria:</label>
                <input type="text" class="inputADM" name="categoriaBusca">
                <button type="submit" class="botoesAdm">Pesquisar</button>
</div>
            </form>
            <div class="exibicaoConsulta">
                <?php
                require_once("conexaoBanco.php");
                $comando = "";

                if (isset($_GET['categoriaBusca']) && $_GET['categoriaBusca'] != "") {
                    $nomeCategoria = $_GET['categoriaBusca'];
                    $comando = "SELECT * FROM categorias WHERE nome LIKE '" . $nomeCategoria . "%'";
                } else {
                    $comando = "SELECT * FROM categorias";
                }

                $resultado = mysqli_query($conexao, $comando);
                $linhas = mysqli_num_rows($resultado);

                if ($linhas == 0) { ?>
                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Não foi encontrado nenhuma categoria!',
                        })
                    </script>
                    <?php
                } else {
                    $arrayCategorias = array();

                    while ($cadaCategoria = mysqli_fetch_assoc($resultado)) {
                        array_push($arrayCategorias, $cadaCategoria);
                    }

                    foreach ($arrayCategorias as $cadaCategoria) { ?>
                    <div class="editaCategoriaa">
                        <p class="nomeCategoriaa "><?= $cadaCategoria['nome'] ?></p>
                        <br>
                        <form id="form1" action="exclusaoCategoria.php" method="POST">
                            <input  type="hidden" name="idCategoria" value="<?= $cadaCategoria['idCategoria'] ?>">
                            <button class="inputt" type="submit">Excluir</button>
                        </form>
                        <form action="edicaoCategoriaForm.php" method="POST">
                            <input  type="hidden" name="idCategoria" value="<?= $cadaCategoria['idCategoria'] ?>">
                            <button class="inputt" type="submit">Editar</button>
                        </form>
                        </div>
                     
                <?php
                    }
                }
                ?>
            </div>
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