<?php
	class conexao{
		public $conn;
		public $stmt;

		public function __construct(){
			$url = "localhost";
			$user = "root";
			$pass = "";
			$db_name = "almoxarifado";
			try{
				$this->conn = new PDO("mysql:dbname=$db_name;host=$url",$user,$pass);
			}
			catch(PDOexception $e){
				echo "Falha na conexão: ". $e;
			}
		}

		public function adicionar($nome,$ca,$uni,$estoque,$min,$val){
			try{
				$this->stmt = $this->conn->prepare("INSERT INTO epis values ('',:nome,:ca,:uni,:estoque,:min,:val)");
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

		public function compra_estoque($nome, $estoque){
				$this->stmt = $this->conn->prepare("UPDATE epis SET estoque = estoque + :estoque WHERE nome = :nome");
				$this->stmt->execute([
					':estoque' => $estoque,
					':nome' => $nome
				]);
		}

		public function ver_saidas(){
			$this->stmt = $this->conn->prepare("SELECT fr.id, fr.nome_funcionario, e.nome, fr.quantidade, fr.data_retirada, a.usuario FROM funcionarios_retira fr, almoxarife a, epis e WHERE fr.epis_id = e.id and fr.almoxarife_id = a.id;");
			$this->stmt->execute();
		}

		public function ver_estoque($pesquisa){
			$pesquisa = $pesquisa."%";
			if($pesquisa == "") $pesquisa = '%';
			$this->stmt = $this->conn->prepare("SELECT * FROM epis e WHERE e.nome LIKE :pesquisa;");
			$this->stmt->execute([':pesquisa' => $pesquisa]);
		}

		public function funcionarios_retira($epi_id, $almoxarife_id, $quantidade, $nome_funcionario) {
			$this->stmt = $this->conn->prepare("SELECT estoque FROM epis WHERE id = :epi_id");
			$this->stmt->execute([':epi_id' => $epi_id]);
			$epi = $this->stmt->fetch(PDO::FETCH_ASSOC);
			
			if ($epi && $epi['estoque'] >= $quantidade) {
				$this->stmt = $this->conn->prepare("UPDATE epis SET estoque = estoque - :quantidade WHERE id = :epi_id");
				$this->stmt->execute([':quantidade' => $quantidade, ':epi_id' => $epi_id]);
				$this->stmt = $this->conn->prepare("INSERT INTO funcionarios_retira (epis_id, almoxarife_id, data_retirada, quantidade, nome_funcionario)
													VALUES (:epis_id, :almoxarife_id, NOW(), :quantidade, :nome_funcionario)");
				$this->stmt->execute([
					':epis_id' => $epi_id,
					':almoxarife_id' => $almoxarife_id,
					':quantidade' => $quantidade,
					':nome_funcionario' => $nome_funcionario
				]);
		
				echo "Retirada registrada com sucesso!";
			} else {
				echo "Estoque insuficiente ou EPI não encontrado!";
			}
		}

		
		function __destruct() {
		    $this->conn == null;
		}
	}
	

	

?>