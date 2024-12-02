<?php
    // Definindo a classe CrtEpi que gerencia as operações relacionadas aos EPIs.
    class CrtEpi{

        // Função para registrar a compra de EPIs.
        public static function compra_epi($conn){

            // Válida os campos da requisição POST.
            if(Auths::validar_post()){
                // Recebe o ID do EPI enviado pelo formulário.
                $tempId = $_POST['epis_id'];
                // Cria uma instância da classe Epi, passando a conexão e o ID do EPI.
                $epi = new Epi($conn, $tempId);
                // Chama o método compra_epi para registrar a compra no banco de dados.
                $epi->compra_epi($_POST["idfornecedor"],$_POST["data_entrega"],$_POST["quantidade"],$_POST["preco_total"]);
                // Exibe uma mensagem de sucesso após a compra ser registrada.
                Respostas::lancar_sucesso("Compra registrada com sucesso!");
            }
            // Inclui a view para o formulário de compra de EPIs.
            include("./App/Resources/Views/Tcompra_epi.php");
        }
    }
?>
