<?php

    class CrtSessao{
        
        //Criando método para criara uma sessão
        public static function criar_sessao($resultado){
            

            if ( password_verify($_POST['senha'], $resultado["senha"])){
                $_SESSION ['logado'] = TRUE;
                $_SESSION ['usuario'] = $_POST['login'];
                $_SESSION ['almoxarife_id'] = $resultado['id'];
                $_SESSION["tipo_acesso"] = $resultado["tipo"];
                
                return TRUE;
            }

            else {
                echo 'senha errada';
                session_destroy();
                return FALSE;
            }
        }

        //Criando método de sair
        public static function sair(){
            
            $_SESSION = array();
            session_destroy();
            header("location: /");
        }
    }