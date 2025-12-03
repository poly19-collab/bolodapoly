<?php

require_once("../config.php");
include_once("../classes/Categoria.php");
include_once("../classes/Produto.php");
include_once("../classes/sql.php");

session_start();

if(!isset($_SESSION['idUsuario'])){
    header("Location: http://localhost/bolodapoly");
}

$name = htmlspecialchars($_POST["selectCategoria"]);

$carregaProdutos = new Produto();
$res = $carregaProdutos->loadProdutosByEdit($name);

$idProduto = $res[0]["idProduto"];
$nomeProduto = $res[0]['nome'];
$descricaoProduto = $res[0]['descricao'];
$precoProduto = $res[0]['preco'];
$qtdProduto = $res[0]['quantidade'];
$fkProduto = $res[0]['idCategoria'];
$imgProduto = $res[0]['imagem'];

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
                <div class="row">
                    <div class="col-md-12">
                        <h3>EDITAR PRODUTO</h3>

                        <form method="POST" action="executaEditarProduto.php">
                            <div class="form-group">
                                <label for="nome" class="label-editavel">Nome</label>
                                <input type="text" name="nome" class="form-control" id="nome"
                                    value="<?php echo $nomeProduto ?>">
                            </div>

                            <div class="form-group">
                                <label for="descricao">Descrição</label>
                                <input type="text" name="descricao" value="<?php echo $descricaoProduto ?>"
                                    class="form-control" id="descricao" placeholder="Informe a descrição">
                            </div>

                            <div class="form-group">
                                <label for="preco">Preço</label>
                                <input type="number" id="precoNumber" value="<?php echo $precoProduto ?>" name="preco"
                                    class="form-control input-edit-numbers" id="preco">
                            </div>

                            <div class="form-group">
                                <label for="qtd">Quantidade</label>
                                <input type="number" name="qtd" id="qtdNumber" class="form-control input-edit-numbers"
                                    id="qtd" placeholder="1" min=1 value="<?php echo $qtdProduto ?>">
                            </div>
                            <div class="form-group">
                                <label for="formFile" class="form-label" id="labelUpload">Upload</label>
                                <input name="inputImagem" id="inputUpload" class="form-control" type="file"
                                    id="formFile">
                            </div>

                            <div class="form-group">
                                <!-- Este campo é enviado junto com o formulário, mas não é visível -->
                                <input type="hidden" name="idProduto" value="<?php echo $idProduto ?>">

                                <!-- Este campo é enviado junto com o formulário, mas não é visível -->
                                <input type="hidden" name="fkProdutoCat" value="<?php echo $fkProduto ?>">

                                <!-- Este campo é enviado junto com o formulário, mas não é visível -->
                                <input type="hidden" name="imagemProduto" value="<?php echo $imgProduto ?>">
                            </div>

                            <br />
                    </div>

                    <br />
                    <div class="form-group">
                        <button type="submit" class="btn btn-success">EDITAR</button>
                    </div>
                    </form>
                    <br /><br />

                </div>
            </div>
        </div>

        <div class="col-md-3">
            <a href="http://localhost/bolodapoly/views/produto.php" class="btn btn-outline-secondary">VOLTAR</a>
        </div>
    </div>
    </div>
</body>

</html>