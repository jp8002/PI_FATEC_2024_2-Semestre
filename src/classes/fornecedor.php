<?php

class Fornecedor{
    public $pdo;
    public $stmt;
    private $nome;
    private $cnpj;
    private $telefone;

    public function __construct($conn){ 
        $this->pdo = $conn;
    }

    public function setNome($tempNome){
        $this->nome = $tempNome;
    }

    public function setCNPJ($tempCNPJ){
        $this->cnpj = $tempCNPJ;
    }

    public function setTelefone($tempTelefone){
        $this->telefone = $tempTelefone;
    }
    
    public function listar_fornecedores(){
        $this->stmt = $this->pdo->conn->prepare("Select * from fornecedor;");
			$this->stmt->execute();
            return $this->stmt;
    }

    public function cadastrar_fornecedor(){
        $this->stmt = $this->pdo->conn->prepare("call cadastrar_fornecedor(:nome, :cnpj, :telefone)");
        $this->stmt->execute([
            ":nome" => $this->nome,
            ":cnpj" => $this->cnpj,
            ":telefone" => $this->telefone
        ]);
    }
}