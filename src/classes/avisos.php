<?php

    class Avisos{
        private $stmt;
        private $pdo;

        private $conteudo;
        private $dia;

        private $id;
        public function __construct($pdo){
            $this->pdo = $pdo;
        }

        public function setConteudo($tempCont){
            $this->conteudo = $tempCont;
        }

        public function setId($tempId){
            $this->id = $tempId;
        }

        public function setDia($tempDia){
            $this->dia = $tempDia;
        }

        public function criar_aviso( $almoxarife_id){
			try{
				$this->stmt = $this->pdo->conn->prepare("insert into aviso (almoxarife_id, conteudo, data_aviso) values (:almoxarife_id, :conteudo, :data);");
				$this->stmt->execute([
					":almoxarife_id" => $almoxarife_id,
					":conteudo"=>$this->conteudo,
					":data"=> $this->dia
				]);
			}
			catch(Exception $e){
				echo "<div class='alert alert-danger' role='alert'>".
					$e .
				"</div>";
			}
		}

        public function desativar_aviso(){
			$this->stmt = $this->pdo->conn->prepare("update aviso a SET a.visibilidade = 0 where a.idaviso = :id;");
			$this->stmt->execute([
			":id" => $this->id
			]);
		}
        public function ver_avisos(){
			
			try{
				$this->stmt = $this->pdo->conn->prepare("select a.idaviso, al.usuario , a.conteudo, a.data_aviso, a.visibilidade from aviso a, almoxarife al where a.almoxarife_id = al.id; ");
				$this->stmt->execute();
				while ($row = $this->stmt->fetch()) {
					if($row["visibilidade"] == 1){
						echo "<ul class='list-group'>";

						echo " <li class='list-group-item d-flex justify-content-between align-items-center btn' data-toggle='collapse' onclick='desativar(". $row['idaviso'] .")' href='#collapse". $row['idaviso'] ."' role='button' aria-expanded='false' aria-controls='collapseExample'>".
								$row['usuario']. " | ". $row['data_aviso'] 
							."</li>"
							;
						
						echo"</ul>";
						
						echo
							"<div class='collapse' id='collapse". $row['idaviso'] ."'>
								<div class='card card-body'>".
									$row['conteudo']
								."</div>
							</div>"
						;

					}
                    
   
                }
			}
			catch(Exception $e){
				echo  
					"<div class='alert alert-danger' role='alert'>
						Erro ao pesquisa: " . $e .
					"</div>";
			}
		}

        public function contagem_avisos(){
			$this->stmt = $this->pdo->conn->prepare("select count(idaviso) as qtd from aviso where visibilidade = 1");
			$this->stmt->execute();
			return $this->stmt->fetch();
		}
    }