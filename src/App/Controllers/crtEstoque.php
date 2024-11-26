<?php

    class CrtEstoque{
        
        public static function Tver_estoque($conn){
            $estoque = new Estoque($conn);
            $pesquisa = isset($_POST["pesquisa"]) ? $_POST["pesquisa"] : "";
            $query= $estoque->ver_estoque( $pesquisa );
            include("App/Resources/Views/Tver_estoque.php");
        }
        public static function adicionarEPI($pdo){
            $estoque = new Estoque($pdo);

            if(Auths::validar_post()){
                $estoque->adicionar($_POST['nome'],$_POST['ca'],$_POST['unidade'],$_POST['estoque'],$_POST['minimo'],$_POST['validade']);
            }
            header('location:/TadicionarEpi');
            
        }

        public static function listar_estoque($pdo){
            $estoque = new Estoque($pdo);
            $pesquisa = isset($_POST['pesquisa']) ? $_POST['pesquisa'] : '%';
            $query = $estoque->ver_estoque($pesquisa);

            echo json_encode($query->fetchAll());
        }

        public static function remover_epi($pdo){

            if(Auths::validar_post()){
                $estoque = new Estoque($pdo);
                $estoque->remover_epi($_POST['epis_id']);
                include('App\Resources\Views\Tremover_epi.php');
            }
            
        }
    }