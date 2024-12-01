<?php 
    // Definindo a classe CrtAvisos que gerencia as operações relacionadas aos avisos.
    class CrtAvisos{
        
        // Função para enviar um aviso.
        public static function enviar_aviso($conn){
            // Verifica se os dados enviados via POST são válidos.
            if (Auths::validar_post()){
                // Cria uma instância do modelo Avisos, passando a conexão do banco.
                $avisos = new Avisos($conn);
                // Chama o método criar_aviso para registrar o novo aviso no banco.
                $avisos->criar_aviso($_SESSION['almoxarife_id'], $_POST['conteudo'], date('Y-m-d'));
                // Exibe uma mensagem de sucesso após o aviso ser enviado.
                Respostas::lancar_sucesso("Alerta enviado com sucesso!");
            }
            
            // Inclui a view para enviar aviso.
            include "App\Resources\Views\Tenviar_aviso.php";
        }

        // Função para verificar os avisos existentes.
        public static function Tchecar_avisos($conn){
            // Cria uma instância do modelo Avisos.
            $avisos = new Avisos($conn);
            // Obtém os avisos do banco de dados.
            $query = $avisos->ver_avisos();
     
            // Inclui a view para exibir os avisos.
            include(viewPath."/Tchecar_avisos.php");
        }

        // Função para desativar um aviso específico.
        public static function desativar_aviso($conn){
            // Verifica se os dados enviados via POST são válidos.
            if (Auths::validar_post()){
                // Cria uma instância do modelo Avisos.
                $aviso = new Avisos($conn);
                // Define o ID do aviso a ser desativado.
                $aviso->avisoId = $_POST['idaviso'];

                // Chama o método para desativar o aviso.
                $aviso->desativar_aviso();
            }
        }

        // Função para contar o número de avisos no sistema.
        public static function contagem_avisos($conn){
            // Cria uma instância do modelo Avisos.
            $avisos = new Avisos($conn);
            // Codifica a contagem de avisos como um JSON.
            echo json_encode($avisos->contagem_avisos());
        }
    }
?>
