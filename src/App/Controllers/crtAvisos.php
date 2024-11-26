<?php
    class CrtAvisos{
        
        public static function enviar_aviso($conn){
            if (Auths::validar_post()){
                $avisos = new Avisos($conn);
                $avisos->criar_aviso($_SESSION['almoxarife_id'], $_POST['conteudo'], date('Y-m-d'));
            }
            
            include "App\Resources\Views\Tenviar_aviso.php";
        }

        public static function Tchecar_avisos($conn){
            $avisos = new Avisos($conn);
            $query = $avisos->ver_avisos();
     
            include(viewPath."/Tchecar_avisos.php");
        }

        public static function desativar_aviso($conn){
            if (Auths::validar_post()){
                $aviso = new Avisos($conn);
                $aviso->avisoId = $_POST['idaviso'];

                $aviso->desativar_aviso();
            }
        }

        public static function contagem_avisos($conn){
            $avisos = new Avisos($conn);
            echo json_encode($avisos->contagem_avisos());
        }
    }