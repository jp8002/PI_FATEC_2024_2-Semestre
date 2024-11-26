<?php

 class Funcionario{
    private $stmt;
    private $pdo;
    public $nome;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function listar_funcionarios() {
        $this->stmt = $this->pdo->conn->prepare("Select * from funcionarios;");
		$this->stmt->execute();
        return $this->stmt;
    }

    public function cadastrar_funcionario() {
        $this->stmt = $this->pdo->conn->prepare("call cadastrar_funcionario(:nome)");
        $this->stmt->execute([
            ":nome" => $this->nome
        ]);
    }
 }