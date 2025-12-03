<?php 
date_default_timezone_set('America/Sao_Paulo');

require_once("../config.php");
include_once("../classes/Produto.php");
include_once("../classes/Sql.php");
include_once("../classes/Carrinho.php");
include_once("../classes/Compra.php");
include_once("../classes/Usuario.php");


session_start();

if(!isset($_SESSION['idUsuario'])){
    header("Location: http://localhost/bolodapoly");
}

$arrayNomes = $_POST["array_serializado_nomes"];
$arrayNomes = unserialize($arrayNomes);

$arrayQtd = $_POST["array_serializado_qtd"];
$arrayQtd = unserialize($arrayQtd);


$idCliente = htmlspecialchars($_POST['idClienteCompra']);
$valor = htmlspecialchars($_POST['valor']);
$data = htmlspecialchars($_POST['data']);;


for ($i=0; $i < count($arrayNomes) ; $i++) {

    $prodAtt = new Produto();
    $nomeEdit = $arrayNomes[$i];
    $qtdCompra = $arrayQtd[$i];

    $pegarQtdBanco = $prodAtt->carregarEstoque($arrayNomes[$i]);
    
    $nvQtd = $pegarQtdBanco[0]['quantidade'];

    $valorLoop = $nvQtd - $qtdCompra;    

    $prodAtt->updateProdutoCarrinho($nomeEdit, $valorLoop);
     
}

$compra = new Compra();
$compra->insertCompras($idCliente, $valor, $data);

$carrinho = new Carrinho();
$carrinho->updateCarrinho($idCliente);

$usu = new Usuario();
$res = $usu->carregarIsAdmin($idCliente);
$iSAdmin = $res[0]["admin"];

header("Location: http://localhost/bolodapoly/views/sistema.php");

/*if($iSAdmin == 1){
    header("Location: http://localhost/bolodapoly/views/sistema.php");
}elseif($iSAdmin == 0){
    header("Location: http://localhost/bolodapoly/views/loja.php");
}*/