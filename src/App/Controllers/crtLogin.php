<?php
    require_once("./App/Models/almoxarife.php");
    require_once("./App/Controllers/crtSessao.php");
    class CrtLogin{

        //Criando método que redireciona para a tela de login
        public static function telaLogin(){
            include("./App/Resources/Views/Tlogin.php");
        }

        //Criando método que realiza o login
        public static function logar($conn){
            
            $almo = new Almoxarife($conn);
            $query = $almo->listar_almoxarife($_POST['login']);
            
            if(!$result = $query->fetch()){
                Respostas::lancar_alerta("Usuário não exite");
                self::telaLogin();
                return;
            }

            crtSessao::criar_sessao($result);
            header("location: /Tmenu");
        }
    }