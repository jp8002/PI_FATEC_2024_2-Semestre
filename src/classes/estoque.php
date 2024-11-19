<?php
    class Estoque{
        private $stmt;

        private $pdo;



        public function __construct($pdo) {
            $this->pdo = $pdo;
            
        }
        
        public function listar_minimo(){
            
            $this->stmt = $this->pdo->conn->prepare("select e.nome, e.estoque, e.minimo from epis e where e.minimo >= e.estoque");
            $this->stmt->execute();
            return $this->stmt->fetchAll();
        }

        public function ver_estoque($pesquisa){
			$pesquisa = $pesquisa."%";
			if($pesquisa == "") $pesquisa = '%';
			$this->stmt = $this->pdo->conn->prepare("call ver_estoque(:pesquisa);");
			$this->stmt->execute([':pesquisa' => $pesquisa]);
            return $this->stmt;
		}

    }