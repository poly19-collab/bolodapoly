<?php

    require_once("../config.php");
    include_once("../classes/Categoria.php");
    include_once("../classes/sql.php");
    include_once("../classes/Usuario.php");

    session_start();

    if(!isset($_SESSION['idUsuario'])){
        header("Location: http://localhost/bolodapoly");
    }

    $categoria = new Categoria();

    $arrayCat = $categoria->loadCategorias();

    $id = $_SESSION['idUsuario'];

    $usu = new Usuario();
    $res = $usu->carregarIsAdmin($id);

    $idAdmin = $res[0]['admin'];

    if($idAdmin == 0){

        if(!isset($_SESSION)){
            session_start();
        }

        session_destroy();

        echo "Somente os administradores podem cadastrar categorias. \u{1F44B}";
        die();
    }
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bolo da Poly - Cadastrar Categoria</title>

    <link rel="icon" href="../img/lacinho.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="../src/css/sistema.css">
    <link rel="stylesheet" href="../src/css/produto.css">
</head>

<body>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link active" href="http://localhost/bolodapoly/views/sistema.php">HOME</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="categoria.php">CADASTRAR CATEGORIA</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="produto.php">CADASTRAR PRODUTO</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="compras.php">MINHAS COMPRAS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">SAIR</a>
        </li>
    </ul>
    <br />
    <div class="container-fluid text-center">
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
                <div class="row">
                    <div class="col-md-12">
                        <h3>CADASTRAR CATEGORIA</h3>

                        <form action="recebeCat.php" method="POST">
                            <div class="form-group">
                                <label for="categoria">Categoria</label>
                                <input type="text" name="categoria" class="form-control" id="categoria"
                                    placeholder="Informe a Categoria">
                            </div>
                            <br />
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">CADASTRAR</button>
                            </div>
                            <br />
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">CATEGORIAS:</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                        for($i=0; $i < count($arrayCat); $i++){
                                            echo "<td>$arrayCat[$i]</td>";                    
                                        }
                                    ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h4>EXCLUIR CATEOGRIA</h4>
                        <form action="excCate.php" method="POST">

                            <select name="myDropdown" id="myDropdown">

                                <?php
                                for($i=0; $i < count($arrayCat); $i++){
                                    echo "<option value='$arrayCat[$i]'>$arrayCat[$i]</option>";
                                }?>

                            </select>

                            <button type="submit" class="btn btn-danger">Excluir</button>
                        </form>
                    </div>

                    <div class="col-md-12">
                        <h4>EDITAR CATEOGRIA</h4>
                        <form action="editCate.php" method="POST">

                            <select name="myDropdown2" id="myDropdown2">

                                <?php
                                for($i=0; $i < count($arrayCat); $i++){
                                    echo "<option value='$arrayCat[$i]'>$arrayCat[$i]</option>";
                                }?>

                            </select>

                            <button type="submit" class="btn btn-primary">Editar</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-3">

            </div>
        </div>
    </div>
</body>

</html>