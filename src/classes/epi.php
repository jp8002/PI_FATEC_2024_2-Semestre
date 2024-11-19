<?php
class epi{

    private $id;
    private $estoque;

    private $nome;
    private $ca;
    private $uni;
   
    private $min;
    private $val;
    private $quantidade;

    private $stmt;

    private $pdo;



    public function __construct($pdo) {
        $this->pdo = $pdo;
        
    }

    public function setId($auxId){
        $this->id = $auxId;
    }

    public function setNome($tempNome){
        $this->nome = $tempNome;
    }

    public function setCA($tempCA){
        $this->ca = $tempCA;
    }

    public function setUni($tempUni){
        $this->uni = $tempUni;
    }

    public function setEstoque($tempEstoque){
        $this->estoque = $tempEstoque;
    }

    public function setMin($tempMin){
        $this->min = $tempMin;
    }

    public function setVal($tempVal){
        $this->val = $tempVal;
    }

    public function setQuantidade($auxQuant){
      $this->quantidade = $auxQuant;
    }
    public function adicionar(){
        try{
            $this->stmt = $this->pdo->conn->prepare("INSERT INTO epis values ('',:nome,:ca,:uni,:estoque,:min,:val)");
            $this->stmt -> execute([
                        ':nome' => $this->nome,
                        ':ca' => $this->ca,
                        ':uni' => $this->uni,
                        ':estoque' => $this->estoque,
                        ':min' => $this->min,
                        ':val' => $this->val
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

    public function checar_estoque(){
        $this->stmt = $this->pdo->conn->prepare("SELECT estoque FROM epis WHERE id = :epis_id");
		$this->stmt->execute([':epis_id' => $this->id] );
		$this->estoque = $this->stmt->fetch(PDO::FETCH_ASSOC);

        if ($this->estoque >= $this->quantidade) {
            return true;
        }    
    }

    public  function remover_epi($idRemo){
        $this->stmt = $this->pdo->conn->prepare('DELETE FROM epis where epis.id = :idRem');
        $this->stmt->execute([
            ":idRem" => $idRemo
        ]);
    }
    
}



?>