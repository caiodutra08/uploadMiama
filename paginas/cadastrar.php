<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../css/cssCadastro.css">
    <link rel="icon" href="../img/zangoose.png">
    <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.css">
    <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>
    <script src="../js/cadastrar.js"></script>

</head>



<body>
    <header>
        <a href="../index.php">
            <h1 id="tituloPrincipal">Zangoose Store</h1>
        </a>
        <img src="../img/ZangooseLogin.png" id="loginLogo" alt="">

        <a href="telaLogin.php" id="entrar" class="menu">Entrar</a>
        <img src="../img/5402435_account_profile_user_avatar_man_icon.svg" id="user">
    </header>

    <section id="mainLogin">
        <h1 id="cadastro">Cadastro</h1>
        <form action="efetuaCadastro.php" method="POST">
            <input type="text" id="nome" name="nome" placeholder="Nome:"> <br>
            <input type="text" id="sobrenome" name="sobrenome" placeholder="Sobrenome:">
            <input type="text" id="email" name="email" placeholder="Email:">
            <input type="text" id="cpf" name="cpf" placeholder="CPF:">
            <input type="text" id="endereco" name="endereco" placeholder="Endereço:">
            <input type="text" id="telefone" name="telefone" placeholder="Telefone:">
            <input type="text" id="login" name="login" placeholder="Usuário:"><br>
            <input type="password" id="senha" name="senha" placeholder="Senha:"><br>

            <button id="logar" onclick="return verificarCadastro()">Cadastrar</button>

        </form>

    </section>
</body>

</html>