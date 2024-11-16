<?php

class Fornecedor{
    public $pdo;
    public $stmt;

    public function __construct($conn){ 
        $this->pdo = $conn;
    }

    public function listar_fornecedores(){
        $this->stmt = $this->pdo->conn->prepare("Select * from fornecedor;");
			$this->stmt->execute();
            return $this->stmt;
    }
}