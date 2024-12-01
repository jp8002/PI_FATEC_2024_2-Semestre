<?php
    // Inclui o modelo Almoxarife, que contém a lógica de negócios relacionada a almoxarifes.
    require_once("App/Models/almoxarife.php");

    // Define a classe CrtAlmoxarife que contém métodos estáticos para gerenciar almoxarifes.
    class CrtAlmoxarife{

        // Método estático para exibir a tela de cadastro de almoxarife.
        public static function TcadastarAlmoxarife(){
            // Inclui a view para cadastrar um almoxarife.
            include "./App/Resources/Views/Tcadastrar_almoxarife.php";
        }

        // Método estático para exibir o histórico de saídas de almoxarifes.
        public static function Thistorico_saidas($conn){
            // Cria uma nova instância do modelo Almoxarife, passando a conexão como parâmetro.
            $almoxarife = new Almoxarife($conn);
            // Chama o método ver_saidas() do modelo para obter as saídas registradas.
            $query = $almoxarife->ver_saidas();
            // Inclui a view que exibe o histórico de saídas.
            include ("App\Resources\Views\Thistorico_saidas.php");
        }

        // Método estático para exibir o histórico de devoluções de almoxarifes.
        public static function Thistorico_devolucao($conn){
            // Cria uma nova instância do modelo Almoxarife, passando a conexão como parâmetro.
            $almoxarife = new Almoxarife($conn);
            // Chama o método ver_entradas() do modelo para obter as devoluções registradas.
            $query = $almoxarife->ver_entradas();
            // Inclui a view que exibe o histórico de devoluções.
            include ("App\Resources\Views\Thistorico_devolucao.php");
        }
        
        // Método estático para cadastrar um novo almoxarife.
        public static function cadastrarAlmoxarife($conn){
            // Cria uma nova instância do modelo Almoxarife, passando a conexão como parâmetro.
            $almoxarife = new Almoxarife($conn);
            // Verifica se os dados enviados via POST são válidos.
            if (Auths::validar_post()){
                // Chama o método cadastrar() do modelo para registrar o novo almoxarife com os dados fornecidos.
                $almoxarife->cadastrar($_POST['usuario'],$_POST["senha"]);
            }
            // Lança uma mensagem de sucesso após o cadastro.
            Respostas::lancar_sucesso("Almoxarife Criado!");
            // Inclui a view para cadastrar um almoxarife novamente (pode ser uma forma de retornar ao formulário).
            include "./App/Resources/Views/Tcadastrar_almoxarife.php";
        }

        // Método estático para registrar a retirada de EPIs.
        public static function retirada_epi($conn){
            // Verifica se os dados enviados via POST são válidos.
            if (Auths::validar_post()){
                // Cria uma nova instância do modelo Almoxarife, passando a conexão como parâmetro.
                $almoxarife = new Almoxarife($conn);
                // Chama o método retirada_epi() do modelo para registrar a retirada dos EPIs com os dados fornecidos.
                $almoxarife->retirada_epi($_POST["epis_id"],$_POST["quantidade"],$_POST["almoxarife_id"],$_POST["idfuncionario"]);
                // Inclui a view que registra a saída dos EPIs.
                include "App\Resources\Views\Tregistrar_saida.php";
            }
        }

        // Método estático para listar todos os almoxarifes cadastrados.
        public static function listar_almoxarife($conn){
            // Cria uma nova instância do modelo Almoxarife, passando a conexão como parâmetro.
            $almoxarife = new Almoxarife($conn);
            // Chama o método listar_almoxarife() do modelo para obter todos os almoxarifes. O parâmetro null indica que não há filtros aplicados.
            $query = $almoxarife->listar_almoxarife(null);
            // Codifica os resultados em formato JSON.
            echo json_encode($query->fetchAll());
        }

        // Método estático para registrar uma devolução de itens retirados por funcionários.
        public static function devolucao($conn){
            // Cria uma nova instância do modelo Almoxarife, passando a conexão como parâmetro.
            $almoxarife = new Almoxarife($conn);
            // Chama o método registrar_devolucao() do modelo com os dados da devolução fornecidos via POST.
            $almoxarife->registrar_devolucao($_POST["funcionarios_retira_id"], $_POST["comentario"]);
            // Lança uma mensagem de sucesso após registrar a devolução.
            Respostas::lancar_sucesso("Devolução registrada com sucesso!");
            // Inclui a view de cadastro de devolução .
            include "App\Resources\Views\Tdevolucao.php";
        }
    }