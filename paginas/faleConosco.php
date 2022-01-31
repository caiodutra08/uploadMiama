<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Fale conosco</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/cssFaleConosco.css">
    <script src="../js/faleConosco.js"></script>
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
            <nav>
                <ul>
                    <li><a href="produtos.php" class="menuu " id="produtos">Produtos</a>
                    </li>
                </ul>
            </nav>

            </li>
            <a href="#" class="menu execp">Fale conosco</a>
            <a href="sobreNos.html" class="menu execp">Sobre nós</a>

        </div>

        <a href="telaLogin.php" id="entrar" class="menu">Entrar</a>
        <img src="../img/5402435_account_profile_user_avatar_man_icon.svg" id="user">


    </header>





    <div id="conteudoPrincipalFaleConosco">

        <div id="div1">
        <h1 style="color: white; margin-left: 30%">Fale Conosco</h1>
            <form action="faleConosco.php">
                <label for="nome"> Nome Completo</label><br><br>
                <input class="input" type="text" id="nome" name="nome"><br><br><br>


                <label for="email"> Email</label><br><br>
                <input class="input" type="text" id="email" name="email"><br><br><br>

                <label for="assunto"> Assunto</label><br><br>
                <select name="assunto" id="assunto" onchange="verificaAssunto(this.value)">
                    <option value="0">Selecione</option>
                    <option value="1">Dúvida</option>
                    <option value="2">Reclamação</option>
                    <option value="3">Elogio</option>
                    <option value="4">Sobre pedido</option>
                    <option value="5">Outro</option>
                </select>
        </div>
        <div id="div2">

            <label for="recado" id="dxrecado">Deixe seu recado:</label><br><br>
            <textarea name="recado" id="recado" cols="30" rows="10"></textarea><br><br>
            <div id="divNumeroPedido">
                <label for="numeroPedido">Insira o número do pedido</label>
                <input class="input" type="text" name="numeroPedido" id="numeroPedido">
            </div>
            <button type="submit" id="buttonSubmit" onclick="return validarFormulario()">Enviar</button>
            
        </div>


    </div>



</body>

</html>