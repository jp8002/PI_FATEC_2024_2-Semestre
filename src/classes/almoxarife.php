<?php
    class almoxarife{
        private $stmt;
        private $pdo; 

        public function __construct($pdo){
            $this->pdo = $pdo;
        }
        //criação da função logar
        public function logar ($login, $senha){
            session_start();
            
            $this->stmt = $this->pdo->conn->prepare("select * from almoxarife where usuario = :login");
            $this->stmt->execute([":login" =>$login]);
            $row = $this->stmt->fetch();

            if($row){
                echo $row["senha"];
                if ( password_verify($senha, $row["senha"])){
                    $_SESSION ['logado'] = TRUE;
                    $_SESSION ['usuario'] = $login;
					$_SESSION ['almoxarife_id'] = $row['id'];
                    return TRUE;
                }

                else {
                    echo 'senha errada';
                    $_SESSION ['logado'] = FALSE;
                    return FALSE;
                }
            }

            else {
                $_SESSION ['logado'] = FALSE;
                return FALSE;
            }
        }


        //criação da função cadastrar
        public function cadastrar($usuario, $senha){
            $crypto = password_hash($senha, PASSWORD_DEFAULT);
            $this->stmt = $this->pdo->conn->prepare("insert into almoxarife values('', :usuario, :senha,'')");
            $this->stmt->execute([
                ":usuario" => $usuario,
                ":senha" => $crypto

            ]);
        }

        public function ver_saidas(){
			$this->stmt = $this->pdo->conn->prepare("SELECT fr.id, e.nome, f.nome_funcionario, fr.quantidade, fr.data_retirada, a.usuario FROM funcionarios_retira fr, almoxarife a, epis e, funcionarios f WHERE fr.epis_id = e.id and fr.almoxarife_id = a.id and fr.funcionarios_idfuncionario = f.idfuncionario;
");
			$this->stmt->execute();
            return $this->stmt;
		}

        public function estoque($pesquisa){
			$pesquisa = $pesquisa."%";
			if($pesquisa == "") $pesquisa = '%';
			$this->stmt = $this->pdo->conn->prepare("SELECT * FROM epis e WHERE e.nome LIKE :pesquisa;");
			$this->stmt->execute([':pesquisa' => $pesquisa]);
            return $this->stmt;
		}

        public function registrar_saida($epi_id, $almoxarife_id, $quantidade, $idfuncionario) {
			$this->stmt = $this->pdo->conn->prepare("SELECT estoque FROM epis WHERE id = :epi_id");
			$this->stmt->execute([':epi_id' => $epi_id]);
			$epi = $this->stmt->fetch(PDO::FETCH_ASSOC);
			
			if ($epi && $epi['estoque'] >= $quantidade) {
				$this->stmt = $this->pdo->conn->prepare("UPDATE epis SET estoque = estoque - :quantidade WHERE id = :epi_id");
				$this->stmt->execute([':quantidade' => $quantidade, ':epi_id' => $epi_id]);
				$this->stmt = $this->pdo->conn->prepare("INSERT INTO funcionarios_retira (epis_id, almoxarife_id, data_retirada, quantidade, funcionarios_idfuncionario)
													VALUES (:epis_id, :almoxarife_id, NOW(), :quantidade, :funcionarios_idfuncionario)");
				$this->stmt->execute([
					':epis_id' => $epi_id,
					':almoxarife_id' => $almoxarife_id,
					':quantidade' => $quantidade,
					':funcionarios_idfuncionario' => $idfuncionario
				]);
		
				echo "Retirada registrada com sucesso!";
			} else {
				echo "Estoque insuficiente ou EPI não encontrado!";
			}
		}

        public function registrar_entrada() {
			try {
				$this->stmt = $this->pdo->conn->prepare("SELECT epis_id, quantidade FROM funcionarios_retira WHERE id = :funcionarios_retira_id");
				$this->stmt->execute([':funcionarios_retira_id' => $_POST["funcionarios_retira_id"]]);
				$retirada = $this->stmt->fetch(PDO::FETCH_ASSOC);
		
				if ($retirada) {
					$this->stmt = $this->pdo->conn->prepare("INSERT INTO devolucao (funcionarios_retira_id, data_entrada, comentario) 
														VALUES (:funcionarios_retira_id, NOW(), :comentario)");
					$this->stmt->execute([
						':funcionarios_retira_id' => $_POST["funcionarios_retira_id"],
						':comentario' => $_POST["comentario"]
					]);
					$epi_id = $retirada['epis_id'];
					$quantidade = $retirada['quantidade'];
		
					$this->stmt = $this->pdo->conn->prepare("UPDATE epis SET estoque = estoque + :quantidade WHERE id = :epi_id");
					$this->stmt->execute([
						':quantidade' => $quantidade,
						':epi_id' => $epi_id
					]);
		
				} 
			} catch (PDOException $e) {
				echo "Erro ao registrar devolução: " . $e->getMessage();
			}
		}

		public function ver_entradas(){
			$this->stmt = $this->pdo->conn->prepare("SELECT d.id, f.nome_funcionario, e.nome, fr.data_retirada, d.data_entrada, d.comentario FROM devolucao d, funcionarios_retira fr, epis e, funcionarios f where d.funcionarios_retira_id = fr.id and fr.funcionarios_idfuncionario = f.idfuncionario and fr.epis_id = e.id;
						");
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

        
    }
?>