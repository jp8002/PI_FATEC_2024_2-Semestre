<?php
    class CrtEpi{

        public static function compra_epi($conn){

            if(Auths::validar_post()){
                $tempId = $_POST['epis_id'];
                $epi = new Epi($conn, $tempId);
                $epi->compra_epi($_POST["idfornecedor"],$_POST["data_entrega"],$_POST["quantidade"],$_POST["preco_total"]);
            }
            include("./App/Resources/Views/Tcompra_epi.php");
        }
    }