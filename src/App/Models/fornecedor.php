<?php

    class Fornecedor{

        private $stmt;
        private $pdo;
        public $nome;
        public $cnpj;
        public $telefone;
        public function __construct($pdo) {
            $this->pdo = $pdo;
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