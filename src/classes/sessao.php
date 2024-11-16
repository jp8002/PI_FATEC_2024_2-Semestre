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
    }
?>