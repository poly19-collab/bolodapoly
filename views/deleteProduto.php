<?php 
require_once("../config.php");
include_once("../classes/Categoria.php");
include_once("../classes/sql.php");
include_once("../classes/Produto.php");

session_start();

if(!isset($_SESSION['idUsuario'])){
    header("Location: http://localhost/bolodapoly");
}

$varProd = htmlspecialchars($_POST["selectCategoriaExcluir"]);


$produtoExcluir = new Produto();
$res = $produtoExcluir->loadProdutoByNameReturnId($varProd);

$idExc = $res['idProduto'];

$produtoExcluir->deleteProduto($idExc);

header("Location: http://localhost/bolodapoly/views/produto.php");
?>