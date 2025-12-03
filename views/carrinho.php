<?php 
require_once("../config.php");
include_once("../classes/Categoria.php");
include_once("../classes/Produto.php");
include_once("../classes/sql.php");

session_start();

if(!isset($_SESSION['idUsuario'])){
    header("Location: http://localhost/bolodapoly");
}

$idCli = $_SESSION['idUsuario'];
$produto = htmlspecialchars($_GET['nome']);
$qtdEstoque = htmlspecialchars($_GET['estoque']);
$preco = htmlspecialchars($_GET['preco']);

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bolo da Poly - Carrinho</title>

    <link rel="icon" href="../img/lacinho.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="../src/css/system.css">
    <link rel="stylesheet" href="../src/css/sistema.css">
    <link rel="stylesheet" href="../src/css/carrinho.css">
    <link rel="stylesheet" href="../src/css/style.css">
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6 bordas form carrinho-ajuste">
                <div class="ajusta-paragrafo">
                    <p>Produto: <?php echo $produto?></p>
                    <p>Quantidade no Estoque: <?php echo $qtdEstoque?></p>
                    <p>Preco: R$ <?php echo $preco ?> </p>
                </div>

                <form action="finalizarCompra.php" method="POST" class="formulario">
                    <div class="form-group">
                        <input type="hidden" name="nomeProduto" value="<?php echo $produto ?>">
                        <input type="hidden" name="qtdEstoque" value="<?php echo $qtdEstoque ?>">
                        <input type="hidden" name="preco" value="<?php echo $preco ?>">
                        <input type="hidden" name="idCli" value="<?php echo $idCli ?>">
                        <label for='qtd'>Informe a Quantidade Desejada</label><br />
                        <input type='number' name='qtdCompra' class='form-control input-tamanho' id='qtd'
                            placeholder='1' min=0 max=<?php echo $qtdEstoque?>><br />
                        <button class="btn btn-success">PAGAR</button>
                        <a href="http://localhost/bolodapoly/views/sistema.php" class="btn btn-success">CANCELAR
                            COMPRA</a>
                    </div>
                </form>
            </div>
            <div class="col-md-3"></div>
        </div>
    </div>
</body>

</html>