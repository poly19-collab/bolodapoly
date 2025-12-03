<?php 

class Compra{

public function insertCompras($id, $valor, $data){
    $sql = new Sql();

     $sql->execQuery("INSERT INTO compras (idClienteCompra, valor, dataCompra) VALUES(:ID, :VALOR, :DT)", [
            ":ID"=>$id,
            ":VALOR"=>$valor,
            ":DT"=>$data
    ]);
}

public function loadCompras($id){
    $sql = new Sql();

     $resultSql = $sql->select("SELECT * FROM compras WHERE idClienteCompra = :ID", [
            ":ID"=>$id
        ]);

    return $resultSql;
}


}