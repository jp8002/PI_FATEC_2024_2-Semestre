<?php
class epi{

    private $stmt;

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function adicionar($nome,$ca,$uni,$estoque,$min,$val){
        try{
            $this->stmt = $this->pdo->conn->prepare("INSERT INTO epis values ('',:nome,:ca,:uni,:estoque,:min,:val)");
            $this->stmt -> execute([
                        ':nome' => $nome,
                        ':ca' => $ca,
                        ':uni' => $uni,
                        ':estoque' => $estoque,
                        ':min' => $min,
                        ':val' => $val
                    ]);
        }
        
        catch(PDOexception $e){
            echo"falha do insert: ". $e;
        }
    
    }

    public function compra_estoque(){
        $this->stmt = $this->pdo->conn->prepare("Insert into compras (epis_id, fornecedor_idfornecedor, data_entrega, quantidade, preco_total) values(:epis_id, :fornecedor_idfornecedor, :data_entrega, :quantidade, :preco_total)");
        $this->stmt->execute([
            ":epis_id" => $_POST["epis_id"],
            ":fornecedor_idfornecedor" => $_POST["fornecedor_idfornecedor"],
            ":data_entrega" => $_POST["data_entrega"],
            ":quantidade" => $_POST["quantidade"],
            ":preco_total" => $_POST["preco_total"]
        ]);
        
        $this->stmt = $this->pdo->conn->prepare("UPDATE epis e SET estoque = estoque + :quantidade WHERE :epis_id= e.id;");
        $this->stmt->execute([
            ':quantidade' => $_POST["quantidade"],
            ':epis_id' => $_POST["epis_id"]
        ]);
    }
}



?>