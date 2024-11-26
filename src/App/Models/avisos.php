<?php

 class Avisos{
    private $pdo; //Criando um atributo para armazenar o objeto PDO
	private $stmt;
	
	public $avisoId;
	//Criando método para setar o atributo PDO
	public function __construct($conn){
		$this->pdo = $conn;
	}

	public function criar_aviso( $almoxarife_id, $conteudo, $dia){
		try{
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
			return $this->stmt;
		}
		catch(Exception $e){
			echo  
				"<div class='alert alert-danger' role='alert'>
					Erro ao pesquisa: " . $e .
				"</div>";
		}
	}

	public function desativar_aviso(){
		$this->stmt = $this->pdo->conn->prepare("update aviso a SET a.visibilidade = 0 where a.idaviso = :id;");
		$this->stmt->execute([
		":id" => $this->avisoId
		]);
	}

	public function contagem_avisos(){
		$this->stmt = $this->pdo->conn->prepare("select count(idaviso) as qtd from aviso where visibilidade = 1");
		$this->stmt->execute();
		return $this->stmt->fetch();
	}
 }