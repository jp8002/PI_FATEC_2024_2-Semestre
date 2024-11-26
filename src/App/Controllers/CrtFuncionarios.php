<?php 
    class CrtFuncionarios{
        public static function listar_funcionarios($conn){
            $funcionario = new Funcionario($conn);
            $query = $funcionario->listar_funcionarios();
            echo json_encode($query->fetchAll());
        }

        public static function cadastrar_funcionario($conn){
            if(Auths::validar_post()){
                $funcionaro = new Funcionario($conn);
                $funcionaro->nome = $_POST["nomeFuncionario"];
                $funcionaro->cadastrar_funcionario();
                Respostas::lancar_sucesso("Funcionário Cadastrado");
            }

            include(viewPath."/Tcadastrar_funcionario.php");
        }
    }