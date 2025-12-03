<?php

require_once("../config.php");
include_once("../classes/Produto.php");
include_once("../classes/Sql.php");

session_start();

if(!isset($_SESSION['idUsuario'])){
    header("Location: http://localhost/bolodapoly");
}

$produtos = new Produto();
$prods = $produtos->loadProdutos();

$idCli = $_SESSION['idUsuario'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bolo da Poly</title>

    <link rel="icon" href="../img/lacinho.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="../src/css/sistema.css">
</head>

<body>

    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link active" href="http://localhost/bolodapoly/views/sistema.php">HOME</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="compras.php">MINHAS COMPRAS</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="logout.php">SAIR</a>
        </li>
    </ul>

    <div class="container-fluid text-center">
        <div class="row">
            <div class="col-md-3">

            </div>
            <div class="col-md-6">
                <?php
                
                if(count($prods) > 0){
                    for ($i=0; $i < count($prods) ; $i++) {

                        $nomeProduto = $prods[$i]["nome"];
                        $imagemProduto = $prods[$i]["imagem"];
                        $descricaoProduto = $prods[$i]["descricao"];
                        $precoProduto = $prods[$i]["preco"];
                        $estoqueProduto = $prods[$i]["quantidade"];

                        echo "<div class='row'>
                                <div class='col-md-12'>
                                    <h1>$nomeProduto</h1>
                                    <img src='../img/$imagemProduto' class='rounded float-left img-fluid img-thumbnail'>
                                    <p>$descricaoProduto - Preço: R$ $precoProduto</p>
                                    <p>Estoque: $estoqueProduto</p>

                                     <form method='GET'>
                                        <div class='form-group'>
                                            <a href='carrinho.php?nome=$nomeProduto&estoque=$estoqueProduto&preco=$precoProduto' class='btn btn-success'>ADICIONAR AO CARRINHO</a><br/>
                                        </div>
                                    </form><br/><br/>
                              </div>";
                    }
                }else{
                    echo "<br/>";
                    echo "Nenhum produto encontrado!";
                }
                
                ?>
            </div>
            <div class="col-md-3">

            </div>
        </div>
    </div>
</body>

</html>