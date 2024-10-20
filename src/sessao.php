<?php
    require "conexao.php";
    class sessao {
        public $pdo = '';
        public function __construct(){
            $this->pdo = new conexao();
        }
         
        //Criando função de logar
        public function logar ($login, $senha){
            echo 'foi';
            session_start();
            
            $stmt = $this->pdo->conn->prepare("select * from almoxarife where usuario = :login");
            $stmt->execute([":login" =>$login]);
            $row = $stmt->fetch();

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

            /*if ($login == 'almoxarife' and $senha == 'almoxarife' or $login == 'supervisor' and $senha == 'supervisor'  ){
                $_SESSION ['logado'] = TRUE;
                $_SESSION ['usuario'] = $login;
                return TRUE;
            }*/

            else {
                echo 'login errado';
                
                $_SESSION ['logado'] = FALSE;
                return FALSE;
            }
        }

        //Criando função de sair
        public function sair(){
        session_start();
        $_SESSION = array();
        session_destroy();
        }

        //Criando função de conta logada
        public function conta_logada () {
            session_start();
            if(!isset($_SESSION["logado"]) || $_SESSION["logado"] !== true){
                return FALSE;
            }
            return TRUE;
        }

        //Criação da função cadastrar usuário

        public function cadastrar($usuario, $senha){
            $crypto = password_hash($senha, PASSWORD_DEFAULT);
            $stmt = $this->pdo->conn->prepare("insert into almoxarife values('', :usuario, :senha)");
            $stmt->execute([
                ":usuario" => $usuario,
                ":senha" => $crypto

            ]);
        }

}