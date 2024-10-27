<?php
    require_once("classes/almoxarife.php");
    require_once("classes/conexao.php");
    require_once("classes/sessao.php");
    require_once("classes/epi.php");


    $pdo = new conexao();
    $almoxarife = new almoxarife($pdo);
    $epi = new epi($pdo);
    $sessao = new sessao();
    $query;

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($_POST["action"] == "login"){
            $login = $_POST['login'];
            $senha = $_POST['senha'];
            if($almoxarife->logar($_POST['login'], $_POST['senha'])) {
                header("location: menu.php");
            }
    
            else{
                header("location:login.php");
            }
        }
    
        else if($_POST["action"] == "Cadastrar"){
            if($_POST["usuario"] != "" && $_POST["senha"] != ""){
                $usuario = $_POST['usuario'];
                $senha = $_POST['senha'];
        
                $almoxarife->cadastrar($_POST['usuario'], $_POST['senha']);
                header("location: login.php");
            }

            else{
                header("location: cadastrar.php");
            }
        }
        
        else if($_POST['action'] == "sair"){
            $sessao->sair();
        }

        else if($_POST["action"] == "adicionar" ){
    
            if($_POST['nome'] != "" && $_POST['ca'] != "" && $_POST['unidade'] != ""  && $_POST['estoque'] != ""  && $_POST['minimo'] != ""  && $_POST['validade'] != ""){
    
                $epi->adicionar($_POST['nome'],$_POST['ca'],$_POST['unidade'],$_POST['estoque'],$_POST['minimo'],$_POST['validade']);
            }
            
            header("location: adicionar.php");
            
        }

        else if($_POST["action"] == "atualizar" ){
            if(validar_post()){
                $epi->compra_estoque();
            }

            header('location: atualizar_estoque.php');
        }

        else if($_POST["action"] == "devolucao"){
            if($_POST["comentario"] == ""){
                $_POST["comentario"] = "(Sem Comentario)";
            }

            if(validar_post()){
                $almoxarife->registrar_entrada();
                header("location: devolucao.php");
            }
            else{
                header("location: devolucao.php");
            }
        }
        
    }
    
    else{
        if (!$sessao->conta_logada()) {
            header("location: login.php");
            exit;
        }
    }

    function ver_saidas($almoxarife){
         return $almoxarife->ver_saidas();
    }

    function ver_estoque($almoxarife, $pesquisa){
        return $almoxarife->estoque($pesquisa);
   }



    function validar_post(){

        foreach ($_POST as $i) {
            if($i == ""){
                return false;
            }
        }   

        return true;

   }

?>
