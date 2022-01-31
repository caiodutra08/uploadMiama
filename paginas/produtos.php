<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Produtos</title>
    <link rel="stylesheet" href="../css/cssProdutos.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="icon" href="../img/zangoose.png">
    <link rel="stylesheet" href="../css/index.css">
    <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.css">
    <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
</head>

<body>
    <header>
        <a href=../index.php> <h1 id="tituloPrincipal">Zangoose Store</h1>
        </a>
        <div class="menuNavegacao">
            <a href="#" class="menu execp">Produtos</a>
            <a href="faleConosco.php" class="menu execp">Fale conosco</a>
            <a href="sobreNos.html" class="menu execp">Sobre nós</a>
        </div>

        <form action="#" method="GET">

            <button type="submit" id="button">
                <img src="../img/3844467_magnifier_search_zoom_icon.svg" alt="">
            </button>
            <input type="text" id="inputPesquisa" name="inputPesquisa">

        </form>
    
        <a href="telaLogin.php" id="entrar" class="menu">Entrar</a>
        <img src="../img/5402435_account_profile_user_avatar_man_icon.svg" id="user">


    </header>

    <div id="conteudoPrincipalProdutos">
        <div id="filtros" id="darkFiltros">
        <img src="../img/ZangooseLogin.png" alt="" id="logozada">

                <p class="filtros">Gamer</p>
                <input type="checkbox" class="gamer" name="gamer"> Periféricos<br>
                <input type="checkbox" class="gamer" name="gamer"> Mesas<br>
                <input type="checkbox" class="gamer" name="gamer"> Computadores<br>
                <input type="checkbox" class="gamer" name="gamer"> Monitores<br>

                <p class="filtros">Marcas</p>

                <input type="checkbox" class="marcas"> Razer<br>
                <input type="checkbox" class="marcas"> Corser<br>
                <input type="checkbox" class="marcas"> Pichau<br>
                <input type="checkbox" class="marcas"> Logithec<br>

                <p class="filtros">Estilo</p>
                <input type="checkbox" class="RGB"> RGB<br>
                <p class="filtros">Layout </p>
                <input type="checkbox" class="layout"> Linear<br>
                <input type="checkbox" class="layout"> Funcional<br>
                <input type="checkbox" class="layout"> Posicional<br>

        </div>
        
        <div id="produtosDiv">

        <?php
                    require_once("conexaoBanco.php");
                    $comando = "";

                    if (isset($_GET['inputPesquisa']) && $_GET['inputPesquisa'] != "") {
                        $nomeProduto = $_GET['inputPesquisa'];
                        $comando = "SELECT * FROM produtos WHERE nome LIKE '%" . $nomeProduto . "%'";
                        // echo $comando;
                    } else {
                        $comando = "SELECT * FROM produtos";
                    }

                    $resultado = mysqli_query($conexao, $comando);
                    $linhas = mysqli_num_rows($resultado);

                    if ($linhas == 0) { ?>

                    <script>
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Não foi encontrado nenhum produto!',
                        })
                    </script>
                    <?php
                        } else {
                            $arrayProdutos = array();

                            while ($cadaProduto = mysqli_fetch_assoc($resultado)) {
                                array_push($arrayProdutos, $cadaProduto);
                            }
                            foreach ($arrayProdutos as $cadaProduto) { ?>                            
                        <div class="divProdutoOrg">
                            <form action="dashboardClienteEfetuarCompraProduto.php" method="POST">
                                <input type="hidden" name="idProduto" value="<?= $cadaProduto['idProduto'] ?>">
                                <img src="../img/imagemProdutos/<?=$cadaProduto['imagem']?>" id="teclado1" alt="">
                                <p><?= $cadaProduto['nome'] ?></p>
                                <p id="avista">À vista</p>
                                <p id="precoExibido"><?= $cadaProduto['preco'] ?></p>
                                <button id="buttonComprar" type="submit">Comprar</button>
                                <p id="desconto">no boleto ou PIX com 12% desconto</p>
                            </form>
                        </div>
                <?php
                        }
                    }
                    ?>

        </div>
    </div>
</body>

</html>