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
        <title>Gestão de Pedidos - ADMIN</title>
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
             alert('Alteração de status concluída com sucesso!');
        </script>";
    } else if (isset($_GET['retorno']) == true && $_GET['retorno'] == 2) {
        echo "<script>
            alert('Não foi possível realizar a alteração de status!');
        </script>";
    }
    ?>

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

        <section>
            <h1>Gerenciar Pedidos</h1>
            <form action="#" method="GET">

                <p>Informe o CPF do cliente</p>

                <div>

                    <label for="cpf">CPF</label>
                    <input type="number" name="cpf" id="cpf" autocomplete="off">

                    <button type="submit">Buscar</button>

                </div>

            </form>
        </section>

        <section id="exibicaoConsulta">

            <table id="table1">
                <th>Data</th><br>
                <th>Nome do Cliente</th><br>
                <th>Status</th><br>
                <th>Produtos</th><br>
                <th>Alterar</th><br>

                <?php

                    require_once("conexaoBanco.php");
                    $comando = "";

                    if (isset($_GET['cpf']) && $_GET['cpf'] != "") {
                        $cpf = $_GET['cpf'];
                        $comando = "SELECT clientes.nome, clientes.sobrenome, pedidos.* FROM clientes INNER JOIN usuarios ON usuarios.idUsuario = clientes.usuarios_idUsuario INNER JOIN pedidos ON pedidos.usuarios_idUsuario = usuarios.idUsuario WHERE clientes.cpf=" . $cpf;
                    } else {
                        $comando = "SELECT clientes.nome, clientes.sobrenome, pedidos.* FROM clientes INNER JOIN usuarios ON usuarios.idUsuario = clientes.usuarios_idUsuario INNER JOIN pedidos ON pedidos.usuarios_idUsuario = usuarios.idUsuario" ;
                    }


                    $resultado = mysqli_query($conexao, $comando);
                    $linhas = mysqli_num_rows($resultado);

                    if ($linhas == 0) { ?>
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Não foi encontrado nenhum pedido com esse cpf!',
                            })
                        </script>
                        <?php

                        }else{
                    $pedidos = array();
                    while ($cadaPedido = mysqli_fetch_assoc($resultado)) {
                        array_push($pedidos, $cadaPedido);
                    }

                    foreach ($pedidos as $cadaPedido) { ?>

                    <tr>
                        <td><?= $cadaPedido['data'] ?></td>
                        <td><?php echo $cadaPedido['nome'] . " " . $cadaPedido['sobrenome']; ?></td>
                        <td><?php

                                    if ($cadaPedido['status'] == 1) {
                                        echo "Em aberto";
                                    } else if ($cadaPedido['status'] == 2) {
                                        echo "Em andamento";
                                    } else {
                                        echo "Finalizado";
                                    }

                                    ?></td>
                        <td>
                            <form action="visualizaProdutosAdm.php" method="POST">
                                <input type="hidden" value="<?= $cadaPedido['idPedido'] ?>" name="idPedido">
                                <button type="submit">Visualizar Produto</button>
                            </form>
                        </td>
                        <td>
                            <form action="alterarStatusPedidoForm.php" method="POST">
                                <input type="hidden" value="<?= $cadaPedido['nome'] ?>" name="nomeCliente">
                                <input type="hidden" value="<?= $cadaPedido['data'] ?>" name="dataPedido">
                                <input type="hidden" value="<?= $cadaPedido['idPedido'] ?>" name="idPedido">
                                <button type="submit">Alterar status</button>
                            </form>

                        </td>
                    </tr>
                <?php
                    }
                }
                    ?>
            </table>

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