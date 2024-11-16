<?php
    class almoxarife{
        private $stmt;
        private $pdo; 

        public function __construct($pdo){
            $this->pdo = $pdo;
        }

        //criação da função cadastrar
        public function cadastrar($usuario, $senha){
            $crypto = password_hash($senha, PASSWORD_DEFAULT);
            $this->stmt = $this->pdo->conn->prepare("insert into almoxarife(usuario,senha) values(:usuario, :senha)");
            $this->stmt->execute([
                ":usuario" => $usuario,
                ":senha" => $crypto

            ]);
        }

        public function ver_saidas(){
			$this->stmt = $this->pdo->conn->prepare("call ver_saidas;");
			$this->stmt->execute();
            return $this->stmt;
		}

        public function ver_estoque($pesquisa){
			$pesquisa = $pesquisa."%";
			if($pesquisa == "") $pesquisa = '%';
			$this->stmt = $this->pdo->conn->prepare("call ver_estoque(:pesquisa);");
			$this->stmt->execute([':pesquisa' => $pesquisa]);
            return $this->stmt;
		}

        public function registrar_saida() {
			$this->stmt = $this->pdo->conn->prepare("SELECT estoque FROM epis WHERE id = :epis_id");
			$this->stmt->execute([':epis_id' => $_POST["epis_id"]]);
			$epi = $this->stmt->fetch(PDO::FETCH_ASSOC);
			
			if ($epi && $epi['estoque'] >= $_POST["quantidade"]) {
				$this->stmt = $this->pdo->conn->prepare("call registrar_saida(:epis_id,:almoxarife_id,:quantidade,:funcionarios_idfuncionario);");

				$this->stmt->execute([
					':epis_id' => $_POST["epis_id"],
					':almoxarife_id' => $_POST["almoxarife_id"],
					':quantidade' => $_POST["quantidade"],
					':funcionarios_idfuncionario' => $_POST["idfuncionario"]
				]);
		
				echo "Retirada registrada com sucesso!";
			} else {
				echo "Estoque insuficiente ou EPI não encontrado!";
			}
		}

        public function registrar_entrada() {
			try {
				$this->stmt = $this->pdo->conn->prepare("SELECT devolvido FROM funcionarios_retira WHERE id = :funcionarios_retira_id");
				$this->stmt->execute([':funcionarios_retira_id' => $_POST["funcionarios_retira_id"]]);
				$retirada = $this->stmt->fetch(PDO::FETCH_ASSOC);
		
				if ($retirada && $retirada['devolvido'] == 0) {
					$this->stmt = $this->pdo->conn->prepare("call registrar_devolucao(:funcionarios_retira_id, :comentario)");
					$this->stmt->execute([
						':funcionarios_retira_id' => $_POST["funcionarios_retira_id"],
						':comentario' => $_POST["comentario"]
					]);
				} 
			} catch (PDOException $e) {
				echo "Erro ao registrar devolução: " . $e->getMessage();
			}
		}

		public function ver_entradas(){
			$this->stmt = $this->pdo->conn->prepare("call ver_entradas;");
			$this->stmt->execute();

			return $this->stmt;
		}
		public function criar_aviso( $usuario, $almoxarife_id){
			try{
				$conteudo = $_POST['conteudo'];
				$dia = date('Y-m-d');

			
				$this->stmt = $this->pdo->conn->prepare("insert into aviso (almoxarife_id, conteudo, data_aviso) values (:almoxarife_id, :conteudo, :data);");
				$this->stmt->execute([
					":almoxarife_id" => $almoxarife_id,
					":conteudo"=>$conteudo,
					":data"=> $dia
				]);
			}
			catch(Exception $e){
				echo "<div class='alert alert-danger' role='alert'>".
					$e .
				"</div>";
			}
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

		public function desativar_aviso($id){
			$this->stmt = $this->pdo->conn->prepare("update aviso a SET a.visibilidade = 0 where a.idaviso = :id;");
			$this->stmt->execute([
			":id" => $id
			]);
		}

		public function contagem_avisos(){
			$this->stmt = $this->pdo->conn->prepare("select count(idaviso) as qtd from aviso where visibilidade = 1");
			$this->stmt->execute();
			return $this->stmt->fetch();
		}

		public function cadastrar_funcionario(){
			$this->stmt = $this->pdo->conn->prepare("call cadastrar_funcionario(:nome)");
			$this->stmt->execute([
				":nome" => $_POST["nomeFuncionario"]
			]);
		}

		public function cadastrar_fornecedor(){
			$this->stmt = $this->pdo->conn->prepare("call cadastrar_fornecedor(:nome, :cnpj, :telefone)");
			$this->stmt->execute([
				":nome" => $_POST["nomeFornecedor"],
				":cnpj" => $_POST["cnpj"],
				":telefone" => $_POST["telefoneFornecedor"]
			]);
		}


        
    }
