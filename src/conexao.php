<?php
	class conexao{
		public $conn;

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
				$stmt = $this->conn->prepare("INSERT INTO epis values ('',:nome,:ca,:uni,:estoque,:min,:val)");
				$stmt -> execute([
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

		public function atualizar_estoque($nome, $estoque){
				$stmt = $this->conn->prepare("UPDATE epis SET estoque = :estoque WHERE nome = :nome");
				$stmt->execute([
					':estoque' => $estoque,
					':nome' => $nome
				]);
		}

		function __destruct() {
		    $this->conn == null;
		}
	}
	

	/*

	$pdo = new conexao();

	$pdo->adicionar('carlos',12354,'par',12,23,'2018-06-24');
*/

?>