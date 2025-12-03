<?php
require_once("../config.php");
include_once("../classes/Categoria.php");
include_once("../classes/sql.php");
include_once("../classes/Produto.php");

session_start();

if(!isset($_SESSION['idUsuario'])){
    header("Location: http://localhost/bolodapoly");
}

$prods = new Produto();
$arrayNomes = $prods->loadProdutosByName();

$naNome = [];

for($i =0; $i < count($arrayNomes); $i++){
    array_push($naNome, $arrayNomes[$i]['nome']);
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bolo da Poly - Edição Produtos</title>

    <link rel="icon" href="../img/lacinho.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="../src/css/system.css">
    <link rel="stylesheet" href="../src/css/sistema.css">
    <link rel="stylesheet" href="../src/css/produto.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
                <form action="produtoEditForm.php" method="post">
                    <div class="form-group">
                        <label for="selectCategoria">Qual produto vamos editar?</label>
                        <select class="form-select" id="selectCategoria" name="selectCategoria"
                            aria-label="Default select example">
                            <?php                                        
                                for($i=0; $i < count($naNome); $i++){
                                    echo "<option value='$naNome[$i]'>$naNome[$i]</option>";                    
                                }
                            ?>
                        </select>
                    </div>
                    <br />
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">SELECIONAR</button>
                    </div>
                </form>
            </div>
            <div class="col-md-3">
            </div>
        </div>
        <br />
        <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
                <form action="deleteProduto.php" method="post">
                    <div class="form-group">
                        <label for="selectCategoriaExcluir">Qual produto vamos deletar?</label>
                        <select class="form-select" id="selectCategoriaExcluir" name="selectCategoriaExcluir"
                            aria-label="Default select example">
                            <?php                                        
                                for($i=0; $i < count($naNome); $i++){
                                    echo "<option value='$naNome[$i]'>$naNome[$i]</option>";                    
                                }
                            ?>
                        </select>
                    </div>
                    <br />
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">EXCLUIR</button>
                    </div>
                </form>
            </div>
            <div class="col-md-3">
            </div>
        </div>
    </div>
</body>

</html>