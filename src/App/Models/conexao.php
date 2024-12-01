<?php

    // Define a classe Conexao para gerenciar a conexão com o banco de dados
    class Conexao{
        
        public $conn; // Atributo público para armazenar o objeto PDO, que representa a conexão com o banco de dados
        private $stmt; // Atributo privado para armazenar os statements (consultas SQL preparadas)
        private $url; // Atributo privado para armazenar o endereço do servidor de banco de dados (IP ou hostname)
        private $user; // Atributo privado para armazenar o nome de usuário do banco de dados
        private $pass; // Atributo privado para armazenar a senha do banco de dados
        private $db_name; // Atributo privado para armazenar o nome do banco de dados

        // Método construtor para inicializar os valores de conexão e estabelecer a conexão com o banco de dados
        public function __construct($url, $user, $pass, $db_name){
            
            // Atribui os parâmetros recebidos às variáveis de instância
            $this->url = $url; 
            $this->user = $user;
            $this->pass = $pass;
            $this->db_name = $db_name;

            try{
                // Cria a conexão PDO utilizando os dados fornecidos (URL, usuário, senha e nome do banco)
                $this->conn = new PDO("mysql:dbname=$this->db_name;host=$this->url", $this->user, $this->pass);
            }
            catch(PDOException $e){
                // Caso ocorra um erro na conexão, exibe a mensagem de erro
                echo "Falha na conexão: ". $e;
            }
        }

        // Método destruidor para fechar a conexão com o banco de dados quando o objeto for destruído
        public function __destruct() {
            // Define o atributo $conn como null, o que encerra a conexão com o banco
            $this->conn = null;
        }

    }
?>
