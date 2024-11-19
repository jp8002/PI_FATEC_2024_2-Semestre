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

		
		function __destruct() {
		    $this->conn == null;
		}
	}
	

	

?>