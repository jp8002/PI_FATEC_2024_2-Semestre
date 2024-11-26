<?php

    class Epi{
        private $id;
        private $nome;
        private $ca;
        private $uni;
        private $estoque;
        private $min;
        private $val;
        private $stmt;
        private $pdo;

        public function __construct($pdo,$tempId) {
            $this->pdo = $pdo;
            $this->setarAtributos($tempId);
        }

        public function getEstoque(){
            return $this->estoque;
        }

        public function getId(){
            return $this->id;
        }    

        public function setarAtributos($tempId) {
            $estoque = new Estoque($this->pdo);
            $query = $estoque->buscarEpi($tempId);
            $this->id = $query['id'];
            $this->nome = $query['nome'];
            $this->ca = $query['CA'];
            $this->uni = $query['unidade'];
            $this->estoque = $query['estoque'];
            $this->min = $query['minimo'];
            $this->val = $query['validade'];

        }

        public function compra_epi($idfornecedor,$data_entrega,$quantidade,$preco_total){
            $this->stmt = $this->pdo->conn->prepare("Insert into compras (epis_id, fornecedor_idfornecedor, data_entrega, quantidade, preco_total) values(:epis_id, :fornecedor_idfornecedor, :data_entrega, :quantidade, :preco_total)");
            $this->stmt->execute([
                ":epis_id" => $this->id,
                ":fornecedor_idfornecedor" => $idfornecedor,
                ":data_entrega" => $data_entrega,
                ":quantidade" => $quantidade,
                ":preco_total" => $preco_total
            ]);
        }
    }