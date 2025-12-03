<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bolo da Poly - Página de Login</title>

    <link rel="icon" href="../img/lacinho.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="src/css/style.css">
    <link rel="icon" href="img/lacinho.png" type="image/png">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 bordas form">
                <h5>PÁGINA DE LOGIN</h5>
                <img class="logo" src="img/logo.png">
                <form action="recebe.php" method="POST" class="formulario">
                    <div class="mb-3">
                        <label for="Usuario" class="form-label">Usuário</label>
                        <input type="text" class="form-control" id="usuario" name="usuario">
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha">
                    </div>
                    <button type="submit" class="btn btn-primary">ENTRAR</button>
                    <a href="http://localhost/bolodapoly/views/cadUsuario.php" class="btn btn-light">Cadastrar
                        Usuário</a>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>

</html>