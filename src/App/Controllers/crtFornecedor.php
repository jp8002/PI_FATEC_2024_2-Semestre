<?php

    class CrtFornecedor{


        public static function listar_fornecedores($conn){
            $fornecedor = new Fornecedor($conn);
            $query = $fornecedor->listar_fornecedores();
            echo json_encode($query->fetchAll());
        }

        public static function cadastrar_fornecedor($conn){
            if(Auths::validar_post()){
                $fornecedor = new Fornecedor($conn);
                
                $fornecedor->nome = $_POST['nomeFornecedor'];
                $fornecedor->cnpj = $_POST['cnpj'];
                $fornecedor->telefone = $_POST['telefoneFornecedor'];

                $fornecedor->cadastrar_fornecedor();
            }

            include "App\Resources\Views\Tcadastrar_fornecedor.php";
        }
    }