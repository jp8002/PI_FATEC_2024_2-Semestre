<?php

    // Define a classe Avisos, que gerencia as operações de manipulação de dodos dos avisos
    class Avisos{
        
        private $pdo; // Atributo para armazenar o objeto PDO, utilizado para a interação com o banco de dados
        private $stmt; // Atributo para armazenar a declaração preparada (PDOStatement)
        
        public $avisoId; // Atributo público para armazenar o ID do aviso 
        
        // Método construtor para inicializar a classe com a conexão PDO
        public function __construct($conn){
            $this->pdo = $conn; // Armazena a conexão PDO recebida no atributo $pdo
        }

        // Método para criar um novo aviso no banco de dados
        public function criar_aviso($almoxarife_id, $conteudo, $dia){
            try{
                // Prepara a consulta SQL para inserir um novo aviso no banco de dados
                $this->stmt = $this->pdo->conn->prepare("insert into aviso (almoxarife_id, conteudo, data_aviso) values (:almoxarife_id, :conteudo, :data);");
                
                // Executa a consulta, passando os parâmetros fornecidos pelo usuário
                $this->stmt->execute([
                    ":almoxarife_id" => $almoxarife_id,  // ID do almoxarife
                    ":conteudo" => $conteudo,  // Conteúdo do aviso
                    ":data" => $dia  // Data do aviso
                ]);
            }
            catch(Exception $e){
                // Exibe um erro caso ocorra uma exceção durante a execução da consulta
                echo "<div class='alert alert-danger' role='alert'>".
                    $e .
                "</div>";
            }
        }

        // Método para visualizar todos os avisos ativos 
        public function ver_avisos(){
            try{
                // Prepara a consulta SQL para buscar todos os avisos 
                $this->stmt = $this->pdo->conn->prepare("select a.idaviso, al.usuario , a.conteudo, a.data_aviso, a.visibilidade from aviso a, almoxarife al where a.almoxarife_id = al.id; ");
                
                // Executa a consulta
                $this->stmt->execute();
                
                // Retorna o resultado da consulta (uma lista de avisos)
                return $this->stmt;
            }
            catch(Exception $e){
                // Exibe um erro caso ocorra uma exceção durante a execução da consulta
                echo  
                    "<div class='alert alert-danger' role='alert'>
                        Erro ao pesquisar: " . $e .
                    "</div>";
            }
        }

        // Método para desativar (ocultar) um aviso, alterando sua visibilidade para 0
        public function desativar_aviso(){
            // Prepara a consulta SQL para atualizar a visibilidade do aviso para 0
            $this->stmt = $this->pdo->conn->prepare("update aviso a SET a.visibilidade = 0 where a.idaviso = :id;");
            
            // Executa a consulta passando o ID do aviso a ser desativado
            $this->stmt->execute([
                ":id" => $this->avisoId  // ID do aviso que será desativado
            ]);
        }

        // Método para contar o número de avisos com visibilidade igual a 1 
        public function contagem_avisos(){
            // Prepara a consulta SQL para contar o número de avisos visíveis
            $this->stmt = $this->pdo->conn->prepare("select count(idaviso) as qtd from aviso where visibilidade = 1");
            
            // Executa a consulta
            $this->stmt->execute();
            
            // Retorna o número de avisos visíveis
            return $this->stmt->fetch();
        }
    }
?>
