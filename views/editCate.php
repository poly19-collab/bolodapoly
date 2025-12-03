<?php

require_once("../config.php");
include_once("../classes/Categoria.php");
include_once("../classes/sql.php");

session_start();

if(!isset($_SESSION['idUsuario'])){
    header("Location: http://localhost/bolodapoly");
}
    $catNome = htmlspecialchars($_POST["myDropdown2"]);

    $categoria = new Categoria();

    $editCategoria = $categoria->loadCategoriasEdit($catNome);

    $varIdEdit = $editCategoria[0]['nomeCategoria'];
    $varCatEdit = $editCategoria[0]['idCategoria'];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bola da Poly - Categoria Edição</title>

    <link rel="icon" href="../img/lacinho.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">

            </div>
            <div class="col-md-6">
                <form action="recebeEditCat.php" method="POST">
                    <div class="form-group">
                        <label for="categoria">ID</label>
                        <input type="text" name="idCategoriaEdit" class="form-control" id="idCategoriaEdit"
                            value="<?php echo $varCatEdit ?>" readonly>
                    </div>

                    <div class="form-group">
                        <label for="nomeCategoria">Categoria</label>
                        <input type="text" name="nomeCategoria" class="form-control" id="nomeCategoria"
                            value="<?php echo $varIdEdit ?>">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">EDITAR</button>
                    </div>

                </form>
            </div>
            <div class="col-md-3">

            </div>
        </div>
    </div>
</body>

</html>