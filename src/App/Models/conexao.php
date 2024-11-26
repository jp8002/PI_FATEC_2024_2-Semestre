<?php

    
    class Conexao{
        public $conn; //Criando um atributo para armazenar o objeto PDO
		private $stmt;//Criando um atributo para armazenar os statemments
		private $url;//Criando um atributo para armazenar o ip do banco
		private $user;//Criando um atributo para armazenar o usuario do banco
		private $pass;//Criando um atributo para armazenar a senha do banco
		private $db_name;//Criando um atributo para armazenar o nome do banco

		//Criando um método contrutor com o objeto de instanciar o objeto PDO
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

		//Criando um  método com o objetivo de fechar a conexão com o banco
		public function __destruct() {
		    $this->conn = null;
		}

    }