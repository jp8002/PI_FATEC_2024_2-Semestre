<?php
    class Almoxarife{

        private $pdo; //Criando um atributo para armazenar o objeto PDO
        private $stmt;
		
		//Criando método para setar o atributo PDO
        public function __construct($conn){
            $this->pdo = $conn;
        }

		public function cadastrar($usuario, $senha){
            $crypto = password_hash($senha, PASSWORD_DEFAULT);
            $stmt = $this->pdo->conn->prepare("insert into almoxarife(usuario,senha) values(:usuario, :senha)");
            $stmt->execute([
                ":usuario" => $usuario,
                ":senha" => $crypto

            ]);
        }

		//Criando método para realizar uma busca no banco de dados com o objetivo de listar os almoxarifes
        public function listar_almoxarife($tempUsuario){
			if($tempUsuario == null) {
				$stmt = $this->pdo->conn->prepare("SELECT * FROM almoxarife");
				$stmt->execute();
				return $stmt;
			}

			$stmt = $this->pdo->conn->prepare("SELECT * FROM almoxarife WHERE	almoxarife.usuario = :tempUsuario");
			$stmt->execute([
				":tempUsuario"=> $tempUsuario
			]);
			return $stmt;
			
		}

        public function retirada_epi($epis_id, $quantidade, $almoxarife_id, $idfuncionario){
            $epi = new Epi($this->pdo, $epis_id);
			
			if ($epi->getEstoque() >= $quantidade) {
				$this->stmt = $this->pdo->conn->prepare("call registrar_saida(:epis_id,:almoxarife_id,:quantidade,:funcionarios_idfuncionario);");

				$this->stmt->execute([
					':epis_id' => $epi->getId(),
					':almoxarife_id' => $almoxarife_id,
					':quantidade' => $quantidade,
					':funcionarios_idfuncionario' => $idfuncionario
				]);
		
				echo "Retirada registrada com sucesso!";
			} else {
				echo "Estoque insuficiente ou EPI não encontrado!";
			}
        }

		public function registrar_devolucao($funcionarios_retira_id, $comentario) {
			try {
				$this->stmt = $this->pdo->conn->prepare("SELECT devolvido FROM funcionarios_retira WHERE id = :funcionarios_retira_id");
				$this->stmt->execute([':funcionarios_retira_id' => $funcionarios_retira_id]);
				$retirada = $this->stmt->fetch(PDO::FETCH_ASSOC);
		
				if ($retirada && $retirada['devolvido'] == 0) {
					$this->stmt = $this->pdo->conn->prepare("call registrar_devolucao(:funcionarios_retira_id, :comentario)");
					$this->stmt->execute([
						':funcionarios_retira_id' => $funcionarios_retira_id,
						':comentario' => $comentario
					]);
				} 
			} catch (PDOException $e) {
				echo "Erro ao registrar devolução: " . $e->getMessage();
			}
		}
		
		public function ver_saidas(){
			$this->stmt = $this->pdo->conn->prepare("call ver_saidas;");
			$this->stmt->execute();
            return $this->stmt;
		}

		public function ver_entradas(){
			$this->stmt = $this->pdo->conn->prepare("call ver_entradas;");
			$this->stmt->execute();

			return $this->stmt;
		}
    }