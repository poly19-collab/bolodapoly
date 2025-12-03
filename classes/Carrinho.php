<?php 

class Carrinho{

public function insertCarrinho($produto, $preco, $quantidade, $id, $fin = 0){
    $sql = new Sql();

     $sql->execQuery("INSERT INTO carrinho (produto, preco, quantidadeProdutos, idCliente, finalizado) VALUES(:PROD, :PRECO, :QTDPROD, :IDC, :FIN)", [
            ":PROD"=>$produto,
            ":PRECO"=>$preco,
            ":QTDPROD"=>$quantidade,
            ":IDC"=>$id,
            ":FIN"=>$fin
        ]);
}

public function buscarCompras($id){
    $sql = new Sql();
    $resultSql = $sql->select("SELECT * FROM carrinho WHERE idCliente = :ID AND finalizado = 0", [
            ":ID"=>$id
    ]);

    return $resultSql;
}

public function updateCarrinho($id){
    $sql = new Sql();

    $sql->execQuery("UPDATE carrinho SET finalizado = 1 WHERE idCliente = :ID", [
        ":ID"=>$id
    ]);
}

public function deletarCarrinho($id){
    $sql = new Sql();

    $sql->execQuery("DELETE FROM carrinho WHERE idCliente = :ID AND finalizado = 0", [
        ":ID"=>$id
    ]);
}

}