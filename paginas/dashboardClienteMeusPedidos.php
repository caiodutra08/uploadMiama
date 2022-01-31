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
        <title>Meus Pedidos - <?= $_SESSION['nome'] ?></title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="../js/clientes.js"></script>
        <link rel="icon" href="../img/zangoose.png">
        <link rel="stylesheet" href="../css/clientes.css">
        <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.css">
        <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
        <link rel="stylesheet" href="../css/dashboardprodutos.css">
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
       
        <div id="tronco">
        <section id="conteudoPrincipal">
            <h3 id="title">Acompanhar pedido</h3>

            <form action="#" method="GET">
                <div id="camposAcompanhaPedido">
                    <label for="dataInical">Data Inicial</label>
                    <input type="date" name="dataInicial" id="dataInicial">

                    <label for="dataFinal">Data Final</label>
                    <input type="date" name="dataFinal" id="dataFinal">
                </div>
                        <button type="submit" id="buscar">Buscar</button>
            </form>
        </section>
        
        <section id="exibicaoConsulta">

            <table>
                <th>Data</th>
                <th>Status</th>
                <th>Produtos</th>

                <?php

                    require_once("conexaoBanco.php");

                    $comando = "";
                    $dataInicial = "";
                    $dataFinal = "";
                    $idCliente = $_SESSION['idUsuario'];

                    if (isset($_GET['dataInicial']) == true || isset($_GET['dataFinal']) == true) {
                        $dataInicial = $_GET['dataInicial'];
                        $dataFinal = $_GET['dataFinal'];

                        if ($dataInicial != "" && $dataFinal == "") {
                            $dataInicial = $_GET['dataInicial'];
                            $dataFinal = date("Y-m-d");
                        } else if ($dataInicial == "" && $dataFinal != "") {
                            $dataFinal = $_GET['dataFinal'];
                            $dataInicial = "2010-01-01";
                        } else if ($dataInicial == "" && $dataFinal == "") {
                            $dataInicial = "2010-01-01";
                            $dataFinal = date("Y-m-d");
                        }
                        $comando = "SELECT * FROM pedidos WHERE usuarios_idUsuario= " . $idCliente . " AND data BETWEEN '" . $dataInicial . " ' AND ' " . $dataFinal . "'";
                        $resultado = mysqli_query($conexao, $comando);
                        $linhas = mysqli_num_rows($resultado);

                        if ($linhas == 0) { ?>
                        <script>
                            Swal.fire({
                                icon: 'error',
                                title: 'Oops...',
                                text: 'Não foi encontrado nenhum pedido!',
                            })
                        </script>
                        <?php
                                } else {
                                    $pedidos = array();
                                    while ($cadaPedido = mysqli_fetch_assoc($resultado)) {
                                        array_push($pedidos, $cadaPedido);
                                    }

                                    foreach ($pedidos as $cadaPedido) { ?>
                            <tr>
                                <td><?php echo date('d/m/Y', strtotime($cadaPedido['data'])); ?></td>
                                <td>
                                    <?php

                                                    if ($cadaPedido['status'] == 1) {
                                                        echo "Em aberto";
                                                    } else if ($cadaPedido['status'] == 2) {
                                                        echo "Em andamento";
                                                    } else {
                                                        echo "Finalizado";
                                                    }
                                                    ?>
                                </td>
                                <td>
                                    <form action="visualizaProdutosCliente.php" method="POST">
                                        <input type="hidden" value="<?= $cadaPedido['idPedido'] ?>" name="idPedido">
                                        <button type="submit" id="visualizar">Visualizar</button>
                                    </form>
                                    
                                </td>
                            </tr>
                <?php
                            }
                        }
                    }

                    ?>
            </table>
            </div> 
        </section>
        
        
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