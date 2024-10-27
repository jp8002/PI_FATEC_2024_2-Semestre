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

		public function criar_aviso( $usuario){
			try{
				$conteudo = $_POST['conteudo'];
				$dia = date('Y-m-d');

			
				$this->stmt = $this->pdo->conn->prepare("insert into alertas (conteudo, data_envio, almoxarife) values (:conteudo, :data, :almoxarife);");
				$this->stmt->execute([
					":conteudo"=>$conteudo,
					":data"=> $dia,
					":almoxarife"=> $usuario
				]);
			}
			catch(Exception $e){
				echo "<div class='alert alert-danger' role='alert'>".
					$e .
				"</div>";
			}
		}

        
    }
?>