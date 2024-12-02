<?php

    class Epi{
        // Atributos privados da classe Epi que armazenam as informações sobre o EPI 
        private $id; // Armazena o ID do EPI
        private $nome; // Armazena o nome do EPI
        private $ca; // Armazena o número do CA 
        private $uni; // Armazena a unidade do EPI
        private $estoque; // Armazena a quantidade em estoque do EPI
        private $min; // Armazena a quantidade mínima de estoque do EPI
        private $val; // Armazena a validade do EPI
        private $stmt; // Atributo para armazenar o statement PDO 
        private $pdo; // Atributo para armazenar o objeto PDO para conexão com o banco de dados

        // Método construtor da classe Epi, que recebe a conexão PDO e o ID do EPI a ser carregado
        public function __construct($pdo, $tempId) {
            $this->pdo = $pdo; // Atribui a conexão PDO ao atributo da classe
            $this->setarAtributos($tempId); // Chama o método para configurar os atributos do EPI com base no ID
        }

        // Método para retornar o estoque do EPI
        public function getEstoque(){
            return $this->estoque; // Retorna a quantidade em estoque do EPI
        }

        // Método para retornar o ID do EPI
        public function getId(){
            return $this->id; // Retorna o ID do EPI
        }    

        // Método para configurar os atributos da classe com os dados do banco de dados, baseado no ID do EPI
        public function setarAtributos($tempId) {
            // Cria uma instância de Estoque para buscar o EPI no banco de dados
            $estoque = new Estoque($this->pdo);
            // Chama o método buscarEpi para pegar os dados do EPI baseado no ID
            $query = $estoque->buscarEpi($tempId);
            // Atribui os valores retornados da consulta aos atributos da classe
            $this->id = $query['id'];
            $this->nome = $query['nome'];
            $this->ca = $query['CA'];
            $this->uni = $query['unidade'];
            $this->estoque = $query['estoque'];
            $this->min = $query['minimo'];
            $this->val = $query['validade'];
        }

        // Método para registrar a compra de um EPI
        public function compra_epi($idfornecedor, $data_entrega, $quantidade, $preco_total){
            // Prepara uma consulta SQL para registrar a compra do EPI no banco de dados
            $this->stmt = $this->pdo->conn->prepare("Insert into compras (epis_id, fornecedor_idfornecedor, data_entrega, quantidade, preco_total) values(:epis_id, :fornecedor_idfornecedor, :data_entrega, :quantidade, :preco_total)");
            // Executa a consulta SQL com os parâmetros recebidos
            $this->stmt->execute([
                ":epis_id" => $this->id, // Passa o ID do EPI
                ":fornecedor_idfornecedor" => $idfornecedor, // Passa o ID do fornecedor
                ":data_entrega" => $data_entrega, // Passa a data de entrega do EPI
                ":quantidade" => $quantidade, // Passa a quantidade de EPI comprados
                ":preco_total" => $preco_total // Passa o preço total da compra
            ]);
        }
    }
?>
