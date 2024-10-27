<?php
    class sessao {
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
    }
?>