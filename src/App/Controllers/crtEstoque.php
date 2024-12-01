<?php

    // Define a classe CrtEstoque, que contém métodos para gerenciar o estoque de EPIs
    class CrtEstoque{
        
        // Método estático para visualizar o estoque
        public static function Tver_estoque($conn){
            // Cria um objeto da classe Estoque com a conexão fornecida
            $estoque = new Estoque($conn);

            // Recupera o valor de "pesquisa" do formulário (se existir) ou define uma string vazia
            $pesquisa = isset($_POST["pesquisa"]) ? $_POST["pesquisa"] : "";

            // Chama o método ver_estoque da classe Estoque para realizar a pesquisa no estoque
            $query= $estoque->ver_estoque($pesquisa);

            // Inclui o arquivo da view que exibe os resultados do estoque
            include("App/Resources/Views/Tver_estoque.php");
        }

        // Método estático para adicionar um novo EPI ao estoque
        public static function adicionarEPI($pdo){
            // Cria um objeto da classe Estoque com a conexão PDO fornecida
            $estoque = new Estoque($pdo);

            // Valida o POST usando a função validar_post da classe Auths
            if(Auths::validar_post()){
                // Chama o método adicionar da classe Estoque para registrar um novo EPI
                $estoque->adicionar($_POST['nome'],$_POST['ca'],$_POST['unidade'],$_POST['estoque'],$_POST['minimo'],$_POST['validade']);

                // Exibe uma mensagem de sucesso usando a classe Respostas
                Respostas::lancar_sucesso("EPI registrado com sucesso!");
            }

            // Inclui o arquivo da view para adicionar um novo EPI
            include('App\Resources\Views\TadicionarEpi.php'); 
        }

        // Método estático para listar o estoque e retornar os dados em formato JSON
        public static function listar_estoque($pdo){
            // Cria um objeto da classe Estoque com a conexão PDO fornecida
            $estoque = new Estoque($pdo);

            // Recupera o valor de "pesquisa" do formulário ou define '%' para pesquisar todos os registros
            $pesquisa = isset($_POST['pesquisa']) ? $_POST['pesquisa'] : '%';

            // Chama o método ver_estoque da classe Estoque para buscar o estoque com o critério de pesquisa
            $query = $estoque->ver_estoque($pesquisa);

            // Converte o resultado da consulta para JSON e retorna
            echo json_encode($query->fetchAll());
        }

        // Método estático para remover um EPI do estoque
        public static function remover_epi($pdo){
            // Valida o POST usando a função validar_post da classe Auths
            if(Auths::validar_post()){
                // Cria um objeto da classe Estoque com a conexão PDO fornecida
                $estoque = new Estoque($pdo);

                // Chama o método remover_epi da classe Estoque para remover o EPI especificado
                $estoque->remover_epi($_POST['epis_id']);

                // Exibe uma mensagem de sucesso usando a classe Respostas
                Respostas::lancar_sucesso("EPI removido com sucesso!");

                // Inclui o arquivo da view para remover um EPI
                include('App\Resources\Views\Tremover_epi.php');

            }
        }
    }

?>
