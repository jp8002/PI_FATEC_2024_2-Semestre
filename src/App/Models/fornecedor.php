<?php

    class Fornecedor{

        private $stmt; // Atributo para armazenar o objeto statement do PDO
        private $pdo;  // Atributo para armazenar o objeto de conexão PDO com o banco de dados
        public $nome;  // Atributo público para armazenar o nome do fornecedor
        public $cnpj;  // Atributo público para armazenar o CNPJ do fornecedor
        public $telefone; // Atributo público para armazenar o telefone do fornecedor

        // Método construtor que recebe a conexão PDO e a armazena no atributo $pdo
        public function __construct($pdo) {
            $this->pdo = $pdo; // Inicializa a conexão com o banco de dados
        }

        // Método para listar todos os fornecedores registrados no banco de dados
        public function listar_fornecedores(){
            // Prepara a consulta SQL para selecionar todos os fornecedores da tabela 'fornecedor'
            $this->stmt = $this->pdo->conn->prepare("Select * from fornecedor;");
            $this->stmt->execute(); // Executa a consulta
            return $this->stmt; // Retorna o resultado da consulta
        }

        // Método para cadastrar um novo fornecedor no banco de dados
        public function cadastrar_fornecedor(){
            // Prepara a consulta SQL para chamar o procedimento armazenado 'cadastrar_fornecedor' com os dados do fornecedor
            $this->stmt = $this->pdo->conn->prepare("call cadastrar_fornecedor(:nome, :cnpj, :telefone)");
            // Executa a consulta passando os valores dos parâmetros para o banco de dados
            $this->stmt->execute([
                ":nome" => $this->nome,        // Passa o nome do fornecedor
                ":cnpj" => $this->cnpj,        // Passa o CNPJ do fornecedor
                ":telefone" => $this->telefone // Passa o telefone do fornecedor
            ]);
        }
    }
?>
