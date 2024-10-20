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
			$this->stmt = $this->conn->prepare("SELECT fr.nome_funcionario, fr.id, e.nome, fr.quantidade, fr.data_retirada, a.usuario FROM funcionarios_retira_epis fr, almoxarife a, epis e WHERE fr.epis_id = e.id and fr.almoxarife_id = a.id;");
			$this->stmt->execute();
		}

		public function ver_estoque($pesquisa){
			$pesquisa = $pesquisa."%";
			if($pesquisa == "") $pesquisa = '%';
			$this->stmt = $this->conn->prepare("SELECT * FROM epis e WHERE e.nome LIKE :pesquisa;");
			$this->stmt->execute([':pesquisa' => $pesquisa]);
		}

		function __destruct() {
		    $this->conn == null;
		}
	}
	

	

?>