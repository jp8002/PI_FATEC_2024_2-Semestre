<?php
    class almoxarife{
        private $stmt;
        private $pdo; 

		public $epi;

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

        public function registrar_saida() {
			$this->epi->setId( $_POST["epis_id"]);
			$this->epi->setQuantidade( $_POST["quantidade"]);
			
			if ($this->epi->checar_estoque()) {
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

		public function listar_almoxarife($tempUsuario = null){
			if($tempUsuario == null) {
				$this->stmt = $this->pdo->conn->prepare("SELECT * FROM almoxarife");
				$this->stmt->execute();
				return $this->stmt;
			}

			$this->stmt = $this->pdo->conn->prepare("SELECT * FROM almoxarife WHERE	almoxarife.usuario = :tempUsuario");
			$this->stmt->execute([
				":tempUsuario"=> $tempUsuario
			]);
			return $this->stmt;
			
		}

		
        
    }
