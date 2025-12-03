<?php 
require_once("../config.php");
include_once("../classes/Categoria.php");
include_once("../classes/Produto.php");
include_once("../classes/sql.php");

session_start();

if(!isset($_SESSION['idUsuario'])){
    header("Location: http://localhost/bolodapoly");
}

$idProduto = htmlspecialchars($_POST['idProduto']);
$nomeProduto = htmlspecialchars($_POST['nome']);
$descricaoProduto = htmlspecialchars($_POST['descricao']);
$precoProduto = htmlspecialchars($_POST['preco']);
$qtdProduto = htmlspecialchars($_POST['qtd']);
$fkProduto = htmlspecialchars($_POST['fkProdutoCat']);

if(isset($_POST['inputImagem']) && !empty($_POST['inputImagem'])){
    $imagem = htmlspecialchars($_POST['inputImagem']);
    echo "Imagem create";
}
else{
    $imagem = htmlspecialchars($_POST['imagemProduto']);
    echo "imagem update";
}

$produtoEdit = new Produto();

$produtoEdit->updateProduto($idProduto, $nomeProduto, $descricaoProduto, $precoProduto, $qtdProduto, $fkProduto, $imagem);

header("Location: http://localhost/bolodapoly/views/produto.php");

?>