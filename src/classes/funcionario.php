<?php

class Funcionario{
    public $pdo;
    public $stmt;

    public function __construct($conn){ 
        $this->pdo = $conn;
    }

    public function listar_funcionarios(){
        $this->stmt = $this->pdo->conn->prepare("Select * from funcionarios;");
			$this->stmt->execute();
            return $this->stmt;
    }
}