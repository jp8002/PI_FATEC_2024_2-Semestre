<?php

    class Estoque{
        private $stmt; // Atributo para armazenar o objeto statement (consulta SQL) do PDO
        private $pdo;  // Atributo para armazenar o objeto de conexão PDO com o banco de dados

        // Método construtor que recebe a conexão PDO e a armazena no atributo $pdo
        public function __construct($pdo) {
            $this->pdo = $pdo; // Inicializa a conexão com o banco de dados
        }

        // Método para adicionar um novo EPI ao estoque
        public function adicionar($nome, $ca, $uni, $estoque, $min, $val){
            try{
                // Prepara a consulta SQL para inserir os dados de um novo EPI na tabela 'epis'
                $this->stmt = $this->pdo->conn->prepare("INSERT INTO epis values ('', :nome, :ca, :uni, :estoque, :min, :val)");
                // Executa a consulta, passando os valores dos parâmetros para o banco de dados
                $this->stmt->execute([
                            ':nome' => $nome,      // Nome do EPI
                            ':ca' => $ca,          // CA do EPI
                            ':uni' => $uni,        // Unidade de medida do EPI
                            ':estoque' => $estoque,// Quantidade de EPI em estoque
                            ':min' => $min,        // Quantidade mínima do EPI em estoque
                            ':val' => $val         // Data de validade do EPI
                        ]);
            }
            catch(PDOexception $e){
                // Caso ocorra algum erro na execução da consulta, exibe uma mensagem de erro
                echo "Falha do insert: ". $e; // Exibe a mensagem de erro da exceção
            }
        }

        // Método para visualizar o estoque de EPIs
        public function ver_estoque($pesquisa){
            // Modifica o parâmetro de pesquisa para permitir busca parcial (com wildcard '%')
            $pesquisa = $pesquisa . "%"; 
            if($pesquisa == "") $pesquisa = '%'; // Se não houver pesquisa, retorna todos os itens do estoque
            // Prepara a consulta SQL para chamar o procedimento armazenado 'ver_estoque' com o parâmetro de pesquisa
            $this->stmt = $this->pdo->conn->prepare("call ver_estoque(:pesquisa);");
            // Executa a consulta, passando o valor de pesquisa para o banco de dados
            $this->stmt->execute([':pesquisa' => $pesquisa]);
            return $this->stmt; // Retorna o resultado da consulta
        }

        // Método para buscar um EPI específico no banco de dados com base no seu ID
        public function buscarEpi($idEpi){
            // Prepara a consulta SQL para buscar o EPI pelo seu ID
            $this->stmt = $this->pdo->conn->prepare("SELECT * from epis WHERE epis.id = :idEpi;");
            // Executa a consulta, passando o ID do EPI como parâmetro
            $this->stmt->execute([':idEpi' => $idEpi]);
            return $this->stmt->fetch(); // Retorna o resultado da consulta (um único registro)
        }

        // Método para remover um EPI do estoque com base no seu ID
        public  function remover_epi($idRemo){
            // Prepara a consulta SQL para excluir o EPI pelo seu ID
            $this->stmt = $this->pdo->conn->prepare('DELETE FROM epis where epis.id = :idRem');
            // Executa a consulta de exclusão, passando o ID do EPI a ser removido
            $this->stmt->execute([":idRem" => $idRemo]);
        }
    }
?>
