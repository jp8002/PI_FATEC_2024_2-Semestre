<?php

    class Funcionario{
        private $stmt; // Atributo para armazenar o objeto de statement do PDO
        private $pdo;  // Atributo para armazenar o objeto de conexão PDO com o banco de dados
        public $nome;  // Atributo público para armazenar o nome do funcionário

        // Método construtor que recebe a conexão PDO e a armazena no atributo $pdo
        public function __construct($pdo) {
            $this->pdo = $pdo; // Inicializa a conexão com o banco de dados
        }

        // Método para listar todos os funcionários registrados no banco de dados
        public function listar_funcionarios() {
            // Prepara a consulta SQL para selecionar todos os funcionários da tabela 'funcionarios'
            $this->stmt = $this->pdo->conn->prepare("Select * from funcionarios;");
            $this->stmt->execute(); // Executa a consulta SQL
            return $this->stmt; // Retorna o objeto statement com o resultado da consulta
        }

        // Método para cadastrar um novo funcionário no banco de dados
        public function cadastrar_funcionario() {
            // Prepara a consulta SQL para chamar o procedimento armazenado 'cadastrar_funcionario' com o nome do funcionário
            $this->stmt = $this->pdo->conn->prepare("call cadastrar_funcionario(:nome)");
            // Executa a consulta, passando o nome do funcionário como parâmetro
            $this->stmt->execute([
                ":nome" => $this->nome // Passa o nome do funcionário para o banco de dados
            ]);
        }
    }
?>
