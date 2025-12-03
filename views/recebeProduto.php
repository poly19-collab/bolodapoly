<?php
require_once("../config.php");
include_once("../classes/Categoria.php");
include_once("../classes/sql.php");
include_once("../classes/Produto.php");

session_start();

if(!isset($_SESSION['idUsuario'])){
    header("Location: http://localhost/bolodapoly");
}

$categoria = new Categoria();

$nome = htmlspecialchars($_POST["nome"]);

if($nome == ""){
    echo "Não posso cadastrar um produto sem o nome \u{1F614} <br/>";
    echo "<a href='http://localhost/bolodapoly/views/produto.php'>Voltar</a>";
    exit;
}

$descricao = htmlspecialchars($_POST["descricao"]);

if($descricao == ""){
    echo "Não posso cadastrar um produto sem a descrição \u{1F614} <br/>";
    echo "<a href='http://localhost/bolodapoly/views/produto.php'>Voltar</a>";
    exit;
}

$preco = htmlspecialchars($_POST["preco"]);

if($preco == ""){
    echo "Não posso cadastrar um produto sem o preço \u{1F614} <br/>";
    echo "<a href='http://localhost/bolodapoly/views/produto.php'>Voltar</a>";
    exit;
}

$qtd = htmlspecialchars($_POST["qtd"]);

if($qtd == ""){
    echo "Não posso cadastrar um produto sem a quantidade \u{1F614} <br/>";
    echo "<a href='http://localhost/bolodapoly/views/produto.php'>Voltar</a>";
    exit;
}

$nomeCategoria = htmlspecialchars($_POST["selectCategoria"]);

$idCategoria = $categoria->loadById($nomeCategoria);

$produto = new Produto();
$produto->createProduto($nome, $descricao, $preco, $qtd, $idCategoria);

header("Location: http://localhost/bolodapoly/views/produto.php");

?>