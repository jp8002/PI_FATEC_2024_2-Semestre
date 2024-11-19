<?php
	class conexao{
		public $conn;
		private $stmt;
		private $url;
		private $user;
		private $pass;
		private $db_name;

		public function __construct($url, $user, $pass, $db_name){
			$this->url = $url;
			$this->user = $user;
			$this->pass = $pass;
			$this->db_name = $db_name;

			try{
				$this->conn = new PDO("mysql:dbname=$this->db_name;host=$this->url",$this->user,$this->pass);
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