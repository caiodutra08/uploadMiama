<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../node_modules/sweetalert2/dist/sweetalert2.css">
    <link rel="stylesheet" href="../css/cssLogin.css">
    <script src="../node_modules/sweetalert2/dist/sweetalert2.all.min.js"></script>

    <title>Sem permissão de acesso</title>
</head>

<body>
    <header>

        <a href="../index.php">
            <h1 id="tituloPrincipal">Zangoose Store</h1>
        </a>
        <img src="../img/ZangooseLogin.png" id="loginLogo" alt="">
    </header>
    <script>
        Swal.fire({
            title: 'Você precisa estar autenticado corretamente para acessar essa página!',
            icon: 'info',
            confirmButtonText: `Clique aqui para fazer login corretamente`,
            allowOutsideClick: false,
            allowEscapeKey: false,
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
                location.replace("logoff.php")
                Swal.fire('Indo fazer login!', '', 'success')
            }
        })
    </script>
</body>

</html>