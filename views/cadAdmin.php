<?php

require_once("../config.php");
include_once("../classes/Sql.php");
include_once("../classes/Usuario.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifique se o campo 'nome' foi enviado e não está vazio
    if (isset($_POST['usuario']) && !empty($_POST['usuario'])) {
        // Pegue os dados do formulário
        $nome = $_POST['usuario'];

    } else {
        echo "Por favor, preencha o campo nome.";
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verifique se o campo 'senha' foi enviado e não está vazio
    if (isset($_POST['senha']) && !empty($_POST['senha'])) {
        // Pegue os dados do formulário
        $senha = $_POST['senha'];
    } else {
        echo "Por favor, preencha o campo nome.";
        exit;
    }

    $admin = 0;

    $usuario = new Usuario();
    $usuario->setUsuario($nome);
    $usuario->setSenha($senha);
    $usuario->setAdmin($admin);

    $usuCad = $usuario->getUsuario();
    $novaSenha = $usuario->getSenha();
    $novoAdmin = $usuario->getAdmin();

    $usuario->createUsuario($usuCad, $novaSenha, $novoAdmin);

    header("Location: http://localhost/bolodapoly/");

}
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bolo da Poly - Cadastrar Administrador</title>

    <link rel="icon" href="../img/lacinho.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="../src/css/cadUsuario.css">
</head>

<body>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 bordas form">
                <h5>CADASTRAR ADMINISTRADOR</h5>
                <img class="logo" src="../img/logo.png">
                <form action="cadastroAdmin.php" method="post" class="formulario">
                    <div class="mb-3">
                        <label for="Usuario" class="form-label">Usuário</label>
                        <input type="text" class="form-control" id="usuario" name="usuario">
                    </div>
                    <div class="mb-3">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="senha" name="senha">
                    </div>
                    <!-- Este é um comentário em HTML 
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" value="0" id="admin" name="admin">
                        <label class="form-check-label" for="admin">
                            Admin
                        </label>
                    </div>-->
                    <button type="submit" class="btn btn-primary">CADASTRAR</button>
                    <a href="http://localhost/bolodapoly/" class="btn btn-light">LOGIN</a>
                </form>
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>

</html>