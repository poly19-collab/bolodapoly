<?php

    require_once("../config.php");
    include_once("../classes/Categoria.php");
    include_once("../classes/Produto.php");
    include_once("../classes/sql.php");
    include_once("../classes/Usuario.php");

    session_start();

    if(!isset($_SESSION['idUsuario'])){
        header("Location: http://localhost/bolodapoly");
    }

    $categoria = new Categoria();

    $arrayCat = $categoria->loadCategorias();
    $produto = new Produto();
    
    $prods = $produto->loadProdutos();

    $id = $_SESSION['idUsuario'];    

    $usu = new Usuario();
    $res = $usu->carregarIsAdmin($id);

    $idAdmin = $res[0]['admin'];

    if($idAdmin == 0){

        if(!isset($_SESSION)){
            session_start();
        }

        session_destroy();

        echo "Somente os administradores podem cadastrar produtos. \u{1F44B}";
        die();
    }
    
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bolo da Poly - Cadastrar Produto</title>

    <link rel="icon" href="../img/lacinho.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="../src/css/produto.css">
    <link rel="stylesheet" href="../src/css/sistema.css">
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
            <a class="nav-link" href="http://localhost/bolodapoly/upload.php">CADASTRAR IMAGENS</a>
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
                        <h3>CADASTRAR PRODUTO</h3>

                        <form action="recebeProduto.php" method="POST">
                            <div class="form-group">
                                <label for="nome" class="label-editavel">Nome</label>
                                <input type="text" name="nome" class="form-control" id="nome"
                                    placeholder="Informe o nome">
                            </div>

                            <div class="form-group">
                                <label for="descricao">Descrição</label>
                                <input type="text" name="descricao" class="form-control" id="descricao"
                                    placeholder="Informe a descrição">
                            </div>

                            <div class="form-group">
                                <label for="preco">Preço</label>
                                <input type="number" name="preco" class="form-control input-edit-numbers" id="preco"
                                    placeholder="R$ 00,00" min=0.00 max=99.00>
                            </div>

                            <div class="form-group">
                                <label for="qtd">Quantidade</label>
                                <input type="number" name="qtd" class="form-control input-edit-numbers" id="qtd"
                                    placeholder="1" min=1>
                            </div>

                            <div class="form-group">
                                <label for="selectCategoria">Categoria</label>
                                <select class="form-select" name="selectCategoria" aria-label="Default select example">
                                    <?php                                        
                                        for($i=0; $i < count($arrayCat); $i++){
                                            echo "<option value='$arrayCat[$i]'>$arrayCat[$i]</option>";                    
                                        }
                                    ?>
                                </select>
                            </div>
                            <br />
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">CADASTRAR</button>
                            </div><br />

                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nome do Produto</th>
                                    <th scope="col">Preço</th>
                                    <th scope="col">Quantidade</th>
                                    <th scope="col">Categoria</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                    
                                        for ($i=0; $i < count($prods); $i++) {

                                            $idProLoop = $prods[$i]['idProduto'];
                                            $nomeProLoop = $prods[$i]['nome'];
                                            $precoProLoop = $prods[$i]['preco'];
                                            $qtdProLoop = $prods[$i]['quantidade'];
                                            $idCatProLoop = $prods[$i]['idCategoria'];

                                            $prodCat = new Categoria();
                                            
                                            echo "<tr>";
                                            echo "<th scope='row'>$idProLoop</th>";
                                            echo "<td>$nomeProLoop</td>";
                                            echo "<td>$precoProLoop</td>";
                                            echo "<td>$qtdProLoop</td>";
                                            echo "<td>" . $prodCat->carregaCat($idCatProLoop) ."</td>";
                                            echo "</tr>";
                                        }            

                                    ?>

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <form action="editProduto.php">
                            <button type="submit" class="btn btn-primary">EDIÇÃO PRODUTOS</button>
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