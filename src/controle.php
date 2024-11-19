<?php
    require_once("classes/almoxarife.php");
    require_once("classes/conexao.php");
    require_once("classes/sessao.php");
    require_once("classes/epi.php");
    require_once("classes/fornecedor.php");
    require_once("classes/funcionario.php");
    require_once("classes/estoque.php");
    require_once("classes/avisos.php");

    $ini = parse_ini_file('../pi.ini');
    $pdo = new conexao($ini['url'], $ini['user'], $ini['pass'], $ini['db_name']);
    $almoxarife = new almoxarife($pdo);
    $funcionario = new Funcionario($pdo);
    $estoque = new Estoque($pdo);
    $epi = new epi($pdo);
    $avisos = new Avisos($pdo);
    $fornecedor = new Fornecedor($pdo);
    $sessao = new sessao();
    $query;
    $count = 0;
    


    

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        if($_POST["action"] == "login"){
            $login = $_POST['login'];
            $senha = $_POST['senha'];
            if($sessao->logar($_POST['login'], $_POST['senha'], $pdo,$almoxarife)) {
                header("location: menu.php");
            }
    
            else{
                header("location:login.php");
            }
        }
    
        else if($_POST["action"] == "Cadastrar"){
            if(validar_post()){
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
    
            if(validar_post()){
                $epi->setNome($_POST['nome']);
                $epi->setCA($_POST['ca']);
                $epi->setUni($_POST['unidade']);
                $epi->setEstoque($_POST['estoque']);
                $epi->setMin($_POST['minimo']);
                $epi->setVal($_POST['validade']);
                $epi->adicionar();
            }
            
            header("location: adicionar.php");
            
        }

        else if($_POST["action"] == "atualizar" ){
            if(validar_post()){
                $epi->compra_estoque();
            }

            header('location: atualizar_estoque.php');
        }

        else if($_POST["action"] == "retirada"){

            if(validar_post()){
                $almoxarife->epi = $epi;
                $almoxarife->registrar_saida();
                header("location: registrar_saida.php");
                
            }
            else{
                header("location: registrar_saida.php");
            }
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
        else if($_POST["action"] == "criar_aviso"){
            if(validar_post()){
                $avisos->setConteudo($_POST['conteudo']);
                $avisos->setDia($dia = date('Y-m-d'));

                $avisos->criar_aviso( $_SESSION["almoxarife_id"]);
                
            }
          
        }
        else if($_POST["action"] == "desativar"){
            $avisos->setId($_POST["idaviso"]);
            $avisos->desativar_aviso();
        }

        else if($_POST["action"] == "contagem"){
            echo json_encode($avisos->contagem_avisos());
        }
        else if($_POST["action"] == "cadastrar_funcionario"){
            if(validar_post()){
                $funcionario->setNome($_POST["nomeFuncionario"]);
                $funcionario->cadastrar_funcionario();
                header("location:cadastrar_funcionario.php");
            }
            header("location:cadastrar_funcionario.php");
        }

        else if($_POST["action"] == "cadastrar_fornecedor"){
            if(validar_post()){
                $fornecedor->setNome($_POST["nomeFornecedor"]);
                $fornecedor->setCNPJ($_POST["cnpj"]);
                $fornecedor->setTelefone($_POST["telefoneFornecedor"]);
                $fornecedor->cadastrar_fornecedor();
                header("location:cadastrar_fornecedor.php");
            }
            header("location:cadastrar_fornecedor.php");
        }

        else if($_POST["action"] == "alerta"){
            echo json_encode($estoque->listar_minimo());
            
        }
        else if($_POST["action"] == "lista_epi"){
            $query = $estoque->ver_estoque("");
            
            echo json_encode($query->fetchAll());
        }

        else if($_POST["action"] == "listar_fornecedor"){
            $query = $fornecedor->listar_fornecedores();
            
            echo json_encode($query->fetchAll());
            
        }

        else if($_POST["action"] == "listar_almoxarife"){
            $query = $almoxarife->listar_almoxarife();
            
            echo json_encode($query->fetchAll());
            
        }

        else if($_POST["action"] == "listar_funcionarios"){
            $query = $funcionario->listar_funcionarios();
            
            echo json_encode($query->fetchAll());
            
        }

        else if($_POST["action"] == "remover_epi"){
            $epi->remover_epi($_POST['epis_id']);
            header("location: remover_epi.php");
            
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

   



    function validar_post(){

        foreach ($_POST as $i) {
            if($i == ""){
                return false;
            }
        }   

        return true;

   }

?>
