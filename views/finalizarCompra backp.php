<?php 
require_once("../config.php");
include_once("../classes/Produto.php");
include_once("../classes/Sql.php");
include_once("../classes/Carrinho.php");

session_start();

if(!isset($_SESSION['idUsuario'])){
    header("Location: http://localhost/bolodapoly");
}

date_default_timezone_set('America/Sao_Paulo');



$total = 1;
$produtos = 0;
$nomeProduto = htmlspecialchars($_POST['nomeProduto']);
$qtdNoEstoque = htmlspecialchars($_POST['qtdEstoque']);
$precoUni = htmlspecialchars($_POST['preco']);
$idCliente = htmlspecialchars($_POST['idCli']);
$qtdCompra = htmlspecialchars($_POST['qtdCompra']);
$qtdNv = $qtdNoEstoque - $qtdCompra;
$dataAtual = date('d/m/Y G:i:s');

$novoValor = $precoUni * $qtdCompra;

$carrinho = new Carrinho();
$carrinho->insertCarrinho($nomeProduto, $precoUni, $qtdCompra, $idCliente);

$res = $carrinho->buscarCompras($idCliente);

for ($i=0; $i < count($res) ; $i++) { 
    $produtos += $res[$i]["quantidadeProdutos"];
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bolo da Poly - Finalizar Compra</title>

    <link rel="icon" href="../img/lacinho.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="../src/css/carrinho.css">
</head>

<body>
    <div class="container">

        <div class="row">
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nome do Produto</th>
                            <th scope="col">Preço</th>
                            <th scope="col">Quantidade</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                                    
                                        for ($i=0; $i < count($res); $i++) {

                                            $idProLoop = $res[$i]['idCarrinho'];
                                            $nomeProLoop = $res[$i]['produto'];
                                            $precoProLoop = $res[$i]['preco'];
                                            $qtdProLoop = $res[$i]['quantidadeProdutos'];
                                            
                                            
                                            echo "<tr>";
                                            echo "<th scope='row'>$idProLoop</th>";
                                            echo "<td>$nomeProLoop</td>";
                                            echo "<td>R$ $precoProLoop</td>";
                                            echo "<td>$qtdProLoop</td>";
                                            echo "</tr>";
                                        }            

                                    ?>

                    </tbody>
                </table>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <p>Total de Produtos no carrinho: <?php echo $produtos ?></p>
                <p>Valor Total da Compra: R$ <?php echo $novoValor ?></p>

                <form action="finalizar.php" method="POST">
                    <div class="form-group">
                        <input type="hidden" name="nomePoduto" value="<?php echo $nomeProduto ?>">
                        <input type="hidden" name="idClienteCompra" value="<?php echo $idCliente ?>">
                        <input type="hidden" name="valor" value="<?php echo $novoValor ?>">
                        <input type="hidden" name="data" value="<?php echo $dataAtual ?>">
                        <input type="hidden" name="novoEstoque" value="<?php echo $qtdNv ?>">
                        <button class="btn btn-success">FINALZIAR</button>
                        <a href="http://localhost/bolodapoly/views/sistema.php" class="btn btn-secondary">MAIS TARDE</a>
                    </div>
                </form>
                <br />
            </div>
            <div class="col-md-4"></div>
        </div>
    </div>
</body>

</html>