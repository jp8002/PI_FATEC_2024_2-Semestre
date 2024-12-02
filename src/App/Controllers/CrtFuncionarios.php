<?php 
    // Define a classe CrtFuncionarios, que contém métodos estáticos para gerenciar os funcionários
    class CrtFuncionarios{
        
        // Método estático para listar todos os funcionários
        public static function listar_funcionarios($conn){
            // Cria um objeto da classe Funcionario, passando a conexão como parâmetro
            $funcionario = new Funcionario($conn);

            // Chama o método listar_funcionarios da classe Funcionario para obter todos os funcionários
            $query = $funcionario->listar_funcionarios();

            // Converte o resultado da consulta para JSON e exibe no formato de resposta
            echo json_encode($query->fetchAll());
        }

        // Método estático para cadastrar um novo funcionário
        public static function cadastrar_funcionario($conn){
            // Valida o POST utilizando o método validar_post da classe Auths 
            if(Auths::validar_post()){
                // Cria um objeto da classe Funcionario, passando a conexão como parâmetro
                $funcionaro = new Funcionario($conn);

                // Atribui o valor do campo 'nomeFuncionario' recebido via POST ao atributo 'nome' do objeto Funcionario
                $funcionaro->nome = $_POST["nomeFuncionario"];

                // Chama o método cadastrar_funcionario da classe Funcionario para registrar o novo funcionário no banco de dados
                $funcionaro->cadastrar_funcionario();

                // Exibe uma mensagem de sucesso usando a classe Respostas
                Respostas::lancar_sucesso("Funcionário cadastrado com sucesso!");
            }

            // Inclui a view que apresenta o formulário para o cadastro de funcionário
            include(viewPath."/Tcadastrar_funcionario.php");
        }
    }
?>
