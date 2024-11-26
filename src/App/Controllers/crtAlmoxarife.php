<?php
    require_once("App/Models/almoxarife.php");
    class CrtAlmoxarife{

        
        public static function TcadastarAlmoxarife(){
            include "./App/Resources/Views/Tcadastrar_almoxarife.php";
        }

        public static function Thistorico_saidas($conn){
            $almoxarife = new Almoxarife($conn);
            $query = $almoxarife->ver_saidas();
            include ("App\Resources\Views\Thistorico_saidas.php");
        }

        public static function Thistorico_devolucao($conn){
            $almoxarife = new Almoxarife($conn);
            $query = $almoxarife->ver_entradas();
            include ("App\Resources\Views\Thistorico_devolucao.php");
        }
        
        public static function cadastrarAlmoxarife($conn){
            $almoxarife = new Almoxarife($conn);
            if (Auths::validar_post()){
                $almoxarife->cadastrar($_POST['usuario'],$_POST["senha"]);
            }
            Respostas::lancar_sucesso("Almoxarife Criado!");
            include "./App/Resources/Views/Tcadastrar_almoxarife.php";
        }

        public static function retirada_epi($conn){

            if (Auths::validar_post()){
                $almoxarife = new Almoxarife($conn);
                $almoxarife->retirada_epi($_POST["epis_id"],$_POST["quantidade"],$_POST["almoxarife_id"],$_POST["idfuncionario"]);
            }
            
            include "App\Resources\Views\Tregistrar_saida.php";
        }

        public static function listar_almoxarife($conn){
            $almoxarife = new Almoxarife($conn );
            $query = $almoxarife->listar_almoxarife(null);
            echo json_encode($query->fetchAll());
        }

        public static function devolucao($conn){
            $almoxarife = new Almoxarife($conn);
            $almoxarife->registrar_devolucao($_POST["funcionarios_retira_id"], $_POST["comentario"]);

            include "App\Resources\Views\Tdevolucao.php";
            
        }

       
    }