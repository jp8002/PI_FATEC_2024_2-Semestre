<?php

    // Define a classe CrtFornecedor, que contém métodos estáticos para gerenciar os fornecedores
    class CrtFornecedor{


        // Método estático para listar todos os fornecedores
        public static function listar_fornecedores($conn){
            // Cria um objeto da classe Fornecedor com a conexão fornecida
            $fornecedor = new Fornecedor($conn);

            // Chama o método listar_fornecedores da classe Fornecedor para obter todos os fornecedores
            $query = $fornecedor->listar_fornecedores();

            // Converte o resultado da consulta para JSON 
            echo json_encode($query->fetchAll());
        }

        // Método estático para cadastrar um novo fornecedor
        public static function cadastrar_fornecedor($conn){
            // Valida o POST usando a função validar_post da classe Auths 
            if(Auths::validar_post()){
                // Cria um objeto da classe Fornecedor com a conexão fornecida
                $fornecedor = new Fornecedor($conn);

                // Atribui os valores recebidos via POST aos atributos do objeto fornecedor
                $fornecedor->nome = $_POST['nomeFornecedor'];
                $fornecedor->cnpj = $_POST['cnpj'];
                $fornecedor->telefone = $_POST['telefoneFornecedor'];

                // Chama o método cadastrar_fornecedor da classe Fornecedor para registrar o novo fornecedor no banco de dados
                $fornecedor->cadastrar_fornecedor();

                // Exibe uma mensagem de sucesso usando a classe Respostas
                Respostas::lancar_sucesso("Fornecedor cadastrado com sucesso!");
            }

            // Inclui o arquivo da view para o cadastro de fornecedor
            include "App\Resources\Views\Tcadastrar_fornecedor.php";
        }
    }
?>
