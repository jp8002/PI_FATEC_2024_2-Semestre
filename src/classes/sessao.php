<?php
    class sessao {
        //Criando função de sair

        public function __construct() {
            session_start();
        }
        public function sair(){
        $_SESSION = array();
        session_destroy();
        
        }

        //Criando função de conta logada
        public function conta_logada () {
            if(!isset($_SESSION["logado"]) || $_SESSION["logado"] !== true){
                return FALSE;
            }
            return TRUE;
        }

        //criação da função logar
        public function logar ($login, $senha, $pdo){
            session_start();
            
            $stmt = $pdo->conn->prepare("select * from almoxarife where usuario = :login");
            $stmt->execute([":login" =>$login]);
            $row = $stmt->fetch();

            if($row){
                echo $row["senha"];
                if ( password_verify($senha, $row["senha"])){
                    $_SESSION ['logado'] = TRUE;
                    $_SESSION ['usuario'] = $login;
					$_SESSION ['almoxarife_id'] = $row['id'];
					$_SESSION["tipo_acesso"] = $row["tipo"];
					
                    return TRUE;
                }

                else {
                    echo 'senha errada';
                    $_SESSION ['logado'] = FALSE;
                    return FALSE;
                }
            }

            else {
                $_SESSION ['logado'] = FALSE;
                return FALSE;
            }
        }
    }
?>