<?php

class Funcionario{
    public $pdo;
    public $stmt;
    private $nome;

    public function __construct($conn){ 
        $this->pdo = $conn;
    }

    public function setNome($tempNome){
        $this->nome = $tempNome;
    }
    public function listar_funcionarios(){
        $this->stmt = $this->pdo->conn->prepare("Select * from funcionarios;");
			$this->stmt->execute();
            return $this->stmt;
    }

    public function cadastrar_funcionario(){
        $this->stmt = $this->pdo->conn->prepare("call cadastrar_funcionario(:nome)");
        $this->stmt->execute([
            ":nome" => $this->nome
        ]);
    }
}