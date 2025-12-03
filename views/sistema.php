<?php

require_once("../config.php");
include_once("../classes/Produto.php");
include_once("../classes/Sql.php");
include_once("../classes/Usuario.php");

session_start();

if(!isset($_SESSION['idUsuario'])){
    header("Location: http://localhost/bolodapoly");
}

$produtos = new Produto();
$prods = $produtos->loadProdutos();

$idCli = $_SESSION['idUsuario'];

?>

<!doctype html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="Polayne Bastos">

    <title>Bolo da Poly - Sistema</title>

    <!-- CSS FILES -->
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600;700&display=swap" rel="stylesheet">

    <link href="../src/css/bootstrap.min.css" rel="stylesheet">

    <link href="../src/css/bootstrap-icons.css" rel="stylesheet">

    <link href="../src/css/system.css" rel="stylesheet">
    <link rel="stylesheet" href="../src/css/sistema.css">

    <link rel="icon" href="../img/lacinho.png" type="image/png">
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

    <main>

        <section class="menu section-padding">
            <div class="container">
                <div class="row">

                    <div class="col-12">
                        <!--<img src="../img/logo.png" class="imagem-logo" alt="">-->
                        <h2 class="text-center mb-lg-5 mb-4">NOSSO CATÁLOGO</h2>
                    </div>

                    <?php
                    
                    if(count($prods) > 0){
                        for ($i=0; $i < count($prods) ; $i++) {

                            $nomeProduto = $prods[$i]["nome"];
                            $imagemProduto = $prods[$i]["imagem"];
                            $descricaoProduto = $prods[$i]["descricao"];
                            $precoProduto = $prods[$i]["preco"];
                            $estoqueProduto = $prods[$i]["quantidade"];

                            echo "<div class='col-lg-4 col-md-6 col-12'>
                                  <div class='menu-thumb'>
                                        <div>
                                            <img src='../img/$imagemProduto' class='img-fluid menu-image'>

                                            <span class='menu-tag span-menu-tag'>$nomeProduto</span>
                                        </div>

                                        <div class='menu-info d-flex flex-wrap align-items-center'>
                                        <h4 class='mb-0'>$nomeProduto</h4>

                                        <span class='descricao'>Descrição: $descricaoProduto</span>

                                        <span class='cor-span'>R$ $precoProduto |&nbsp</span><br/>
                                        
                                        <span class='cor-span'>Estoque: $estoqueProduto</span>
                                        
                                        <form method='GET'>
                                            <div class='form-group'>
                                                <a href='carrinho.php?nome=$nomeProduto&estoque=$estoqueProduto&preco=$precoProduto' class='btn btn-success'>ADICIONAR AO CARRINHO</a><br/>
                                            </div>
                                        </form><br/><br/>
                                        </div>
                                  </div>  
                            </div>";                            
                        }
                    }else{
                        echo "<br/>";
                        echo "Nenhum produto encontrado!";
                    }
                    
                    ?>

                </div>
            </div>
        </section>

    </main>

    <footer class="site-footer section-padding">

        <div class="container">

            <div class="row">

                <div class="col-12">
                    <h4 class="text-white mb-4 me-5">Bolo da Poly</h4>
                </div>

                <div class="col-lg-4 col-md-7 col-xs-12 tooplate-mt30">
                    <h6 class="text-white mb-lg-4 mb-3">Localização</h6>

                    <p>Rua São Sebastião, N° 650 - Centro - Irapuã/SP</p>

                    <a href="https://maps.app.goo.gl/iPZjZoNi2EXtm5U2A" target="_blank"
                        class="custom-btn btn btn-secondary mt-2">Como Chegar</a>
                </div>

                <div class="col-lg-4 col-md-5 col-xs-12 tooplate-mt30">
                    <h6 class="text-white mb-lg-4 mb-3">Horário de Funcionamento</h6>

                    <p class="mb-2">Segunda - Sexta</p>

                    <p>07:00 - 16:00</p>

                    <p class="mb-2">Sábado</p>

                    <p>07:00 - 19:00</p>

                </div>

                <div class="col-lg-4 col-md-6 col-xs-12 tooplate-mt30">
                    <h6 class="text-white mb-lg-4 mb-3">Contato</h6>

                    <ul class="social-icon">
                        <li><a href="#"></a><i class="fa-brands fa-whatsapp"></i>17 99210-3745</li>

                        <li><a href="https://www.instagram.com/bolodapoly.1/" target="_blank"><i
                                    class="fa-brands fa-instagram"></i>Instagram</a>
                        </li>
                    </ul>

                    <p class="copyright-text tooplate-mt60">Copyright © <?php echo date('Y') ?> Bolo da Poly Co., Ltd.
                        <br>Criado por: <a rel="nofollow" href="#" target="_blank">Polayne Bastos</a>
                    </p>

                </div>

            </div><!-- row ending -->

        </div><!-- container ending -->

    </footer>

    <!-- Modal -->
    <div class="modal fade" id="BookingModal" tabindex="-1" aria-labelledby="BookingModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h3 class="mb-0">Reserve a table</h3>

                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body d-flex flex-column justify-content-center">
                    <div class="booking">

                        <form class="booking-form row" role="form" action="#" method="post">
                            <div class="col-lg-6 col-12">
                                <label for="name" class="form-label">Full Name</label>

                                <input type="text" name="name" id="name" class="form-control" placeholder="Your Name"
                                    required>
                            </div>

                            <div class="col-lg-6 col-12">
                                <label for="email" class="form-label">Email Address</label>

                                <input type="email" name="email" id="email" pattern="[^ @]*@[^ @]*" class="form-control"
                                    placeholder="your@email.com" required>
                            </div>

                            <div class="col-lg-6 col-12">
                                <label for="phone" class="form-label">Phone Number</label>

                                <input type="telephone" name="phone" id="phone" pattern="[0-9]{3}-[0-9]{3}-[0-9]{4}"
                                    class="form-control" placeholder="123-456-7890">
                            </div>

                            <div class="col-lg-6 col-12">
                                <label for="people" class="form-label">Number of persons</label>

                                <input type="text" name="people" id="people" class="form-control"
                                    placeholder="12 persons">
                            </div>

                            <div class="col-lg-6 col-12">
                                <label for="date" class="form-label">Date</label>

                                <input type="date" name="date" id="date" value="" class="form-control">
                            </div>

                            <div class="col-lg-6 col-12">
                                <label for="time" class="form-label">Time</label>

                                <select class="form-select form-control" name="time" id="time">
                                    <option value="5" selected>5:00 PM</option>
                                    <option value="6">6:00 PM</option>
                                    <option value="7">7:00 PM</option>
                                    <option value="8">8:00 PM</option>
                                    <option value="9">9:00 PM</option>
                                </select>
                            </div>

                            <div class="col-12">
                                <label for="message" class="form-label">Special Request</label>

                                <textarea class="form-control" rows="4" id="message" name="message"
                                    placeholder=""></textarea>
                            </div>

                            <div class="col-lg-4 col-12 ms-auto">
                                <button type="submit" class="form-control">Submit Request</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="modal-footer"></div>

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