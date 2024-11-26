<?php

    class Estoque{
        private $stmt;
        private $pdo;
        public function __construct($pdo) {
            $this->pdo = $pdo;
        }

        public function adicionar($nome,$ca,$uni,$estoque,$min,$val){
            try{
                $this->stmt = $this->pdo->conn->prepare("INSERT INTO epis values ('',:nome,:ca,:uni,:estoque,:min,:val)");
                $this->stmt -> execute([
                            ':nome' => $nome,
                            ':ca' => $ca,
                            ':uni' => $uni,
                            ':estoque' => $estoque,
                            ':min' => $min,
                            ':val' => $val
                        ]);
            }
            
            catch(PDOexception $e){
                echo"falha do insert: ". $e;
            }
        }

        public function ver_estoque($pesquisa){
			$pesquisa = $pesquisa."%";
			if($pesquisa == "") $pesquisa = '%';
			$this->stmt = $this->pdo->conn->prepare("call ver_estoque(:pesquisa);");
			$this->stmt->execute([':pesquisa' => $pesquisa]);
            return $this->stmt;
		}

        public function buscarEpi($idEpi){
            $this->stmt = $this->pdo->conn->prepare("SELECT * from epis WHERE epis.id = :idEpi;");
			$this->stmt->execute([':idEpi' => $idEpi]);
            return $this->stmt->fetch();
        }

        public  function remover_epi($idRemo){
            $this->stmt = $this->pdo->conn->prepare('DELETE FROM epis where epis.id = :idRem');
            $this->stmt->execute([
                ":idRem" => $idRemo
            ]);
        }
    }