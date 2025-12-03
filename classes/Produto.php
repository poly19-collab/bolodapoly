<?php

class Produto{

    private $nome;
    private $descricao;
    private $preco;
    private $qtd;
    private $idCategoria;
    private $imagem;

    public function getNome(){
        return $this->nome;
    }

    public function setNome($var){
        $this->nome = $var;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function setDescricao($var){
        $this->descricao = $var;
    }

    public function getPreco(){
        return $this->preco;
    }

    public function setPreco($var){
        $this->preco = $var;
    }

    public function getQtd(){
        return $this->qtd;
    }

    public function setQtd($var){
        $this->qtd = $var;
    }

    public function getIdCategoria(){
        return $this->idCategoria;
    }

    public function setIdCategoria($var){
        $this->idCategoria = $var;
    }

    public function getImagem(){
        return $this->imagem;
    }

    public function setImagem($var){
        $this->imagem = $var;
    }

    public function loadProdutos(){   
        $sql = new Sql();

        $resultSql = $sql->select("SELECT * FROM produtos");

        return $resultSql;
    }

    public function loadProdutosByName(){   
        $sql = new Sql();

        $resultSql = $sql->select("SELECT nome FROM produtos");

        return $resultSql;
    }

    public function loadProdutoByNameReturnId($nome){
        $sql = new Sql();

        $resultSql = $sql->select("SELECT idProduto FROM produtos WHERE nome = :NOME", [
            ":NOME"=>$nome
        ]);

        return $resultSql[0];
    }

    public function createProduto($nome, $descricao, $preco, $qtd, $idCategoria){
        $sql = new Sql();

        $sql->execQuery("INSERT INTO produtos (nome, descricao, preco, quantidade, idCategoria) VALUES(:NOME, :DESCRI, :PRECO, :QTD, :ID)", [
            ":NOME"=>$nome,
            ":DESCRI"=>$descricao,
            ":PRECO"=>$preco,
            ":QTD"=>$qtd,
            ":ID"=>$idCategoria
        ]);
    }

    public function deleteProduto($id){
        $sql = new Sql();

        $sql->execQuery("DELETE FROM produtos WHERE idProduto = :ID", [
            ":ID"=>$id
        ]);
    }

    public function updateProduto($idProduto, $nomeProduto, $descricaoProduto, $precoProduto, $qtdProduto, $fkProduto, $imagem){
        $sql = new Sql();

        $sql->execQuery("UPDATE produtos SET nome = :NOME, descricao = :DESCRI, preco = :PRECO, quantidade = :QTD, idCategoria = :IDCAT, imagem = :IMG WHERE idProduto = :ID", [
            ":NOME"=>$nomeProduto,
            ":DESCRI"=>$descricaoProduto,
            ":PRECO"=>$precoProduto,
            ":QTD"=>$qtdProduto,
            ":IDCAT"=>$fkProduto,
            ":IMG"=>$imagem,
            ":ID"=>$idProduto
        ]);
    }

    public function updateProdutoCarrinho($nome, $novoEstoque){
        $sql = new Sql();

        $sql->execQuery("UPDATE produtos SET quantidade = :QTD WHERE nome = :NOME", [
            ":QTD"=>$novoEstoque,
            ":NOME"=>$nome
        ]);
    }

    public function loadProdutosByEdit($name){   
        $sql = new Sql();

        $resultSql = $sql->select("SELECT * FROM produtos WHERE nome = :NOME",[
            ":NOME"=>$name
        ]);

        return $resultSql;
    }

    public function carregarEstoque($nome){
        $sql = new Sql();

        $resultSql = $sql->select("SELECT quantidade FROM produtos WHERE nome = :NOME",[
            ":NOME"=>$nome
        ]);

        return $resultSql;
    }

}

?>