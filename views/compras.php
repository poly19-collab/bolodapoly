<?php

require_once("../config.php");
include_once("../classes/Produto.php");
include_once("../classes/Sql.php");
include_once("../classes/Compra.php");
include_once("../classes/Usuario.php");

session_start();

if(!isset($_SESSION['idUsuario'])){
    header("Location: http://localhost/bolodapoly");
}


$idCli = $_SESSION['idUsuario'];

$compras = new Compra();
$comprasEfetuadas = $compras->loadCompras($idCli);

$usu = new Usuario();
$resultUsu = $usu->carregarUsuario($idCli);
$cliente = $resultUsu[0]['usuario'];

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bolo da Poly - Minhas Compras</title>

    <link rel="icon" href="../img/lacinho.png" type="image/png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous">
    </script>

    <link rel="stylesheet" href="../src/css/system.css">
    <link rel="stylesheet" href="../src/css/sistema.css">

    <link rel="stylesheet" href="../src/css/sistema.css">
    <link rel="stylesheet" href="../src/css/minhasCompras.css">
</head>

<body>

    <nav class="navbar navbar-expand-lg shadow-lg">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><i class="fa fa-bars" aria-hidden="true"></i></span>
            </button>

            <a class="navbar-brand" href="http://localhost/bolodapoly/views/sistema.php">
                Bolo da Poly
            </a>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="nav navbar-nav mx-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="http://localhost/bolodapoly/views/sistema.php">Home</a>
                    </li>

                    <?php

                        $usuAdm = new Usuario();
                        $resAdm = $usuAdm->carregarIsAdmin($idCli);
                        $idAdm = $resAdm[0]['admin'];
                        
                        if($idAdm == 1){
                            echo "<li class='nav-item'>
                        <a class='nav-link' href='categoria.php'>Cadastrar Categoria</a>
                        </li>
                        <li class='nav-item'>
                            <a class='nav-link' href='produto.php'>Cadastrar Produto</a>
                        </li>";
                        }

                    ?>

                    <li class="nav-item">
                        <a class="nav-link" href="compras.php">Minhas Compras</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Sair</a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>

    <div class="container-fluid text-center">
        <div class="row">
            <div class="col-md-3">

            </div>
            <div class="col-md-6">
                <?php

                    if(count($comprasEfetuadas) == 0){
                        echo "<br/>";
                        echo "<p id='paragrafoCli'>$cliente, Você ainda não efetou nenhuma compra!</p>";
                    }else{
                        echo "<br/>";
                        echo "<p id='paragrafoCli'>Aqui estão suas compras, $cliente</p>";
                    }
                ?>
                <br />
                <div class="row">
                    <div class="col-md-12">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Cliente</th>
                                    <th scope="col">Valor</th>
                                    <th scope="col">Data</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                    
                                        for ($i=0; $i < count($comprasEfetuadas); $i++) {

                                            $idProLoop = $comprasEfetuadas[$i]['idCompra'];
                                            $nomeProLoop = $cliente;
                                            $valorProLoop = $comprasEfetuadas[$i]['valor'];
                                            $dataProLoop = $comprasEfetuadas[$i]['dataCompra'];
                                            
                                            
                                            echo "<tr>";
                                            echo "<th scope='row'>$idProLoop</th>";
                                            echo "<td>$nomeProLoop</td>";
                                            echo "<td>$valorProLoop</td>";
                                            echo "<td>$dataProLoop</td>";
                                            echo "</tr>";
                                        }            

                                    ?>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-md-3">

            </div>
        </div>
    </div>

    <!-- JAVASCRIPT FILES -->
    <script src="../js/jquery.min.js"></script>
    <script src="../js/bootstrap.bundle.min.js"></script>
    <script src="../js/custom.js"></script>
    <script src="https://kit.fontawesome.com/1eca7f99a6.js" crossorigin="anonymous"></script>
</body>

</html>