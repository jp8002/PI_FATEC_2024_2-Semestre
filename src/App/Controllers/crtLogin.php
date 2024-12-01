<?php
    // Inclui os arquivos necessários para o funcionamento do código
    require_once("./App/Models/almoxarife.php"); 
    require_once("./App/Controllers/crtSessao.php"); 

    // Define a classe CrtLogin, responsável por gerenciar as ações de login
    class CrtLogin{

        // Método estático para exibir a tela de login
        public static function telaLogin(){
            // Inclui a view que apresenta o formulário de login
            include("./App/Resources/Views/Tlogin.php");
        }

        // Método estático para realizar o login de um usuário
        public static function logar($conn){
            // Cria um objeto da classe Almoxarife, passando a conexão como parâmetro
            $almo = new Almoxarife($conn);

            // Chama o método listar_almoxarife para buscar o usuário no banco de dados com o login informado no formulário
            $query = $almo->listar_almoxarife($_POST['login']);
            
            // Verifica se o usuário não existe 
            if(!$result = $query->fetch()){
                // Exibe uma mensagem de alerta informando que o usuário não foi encontrado
                Respostas::lancar_alerta("Usuário não exite");
                // Chama o método telaLogin para exibir novamente a tela de login
                self::telaLogin();
                return; // Interrompe a execução do método aqui
            }

            // Se o usuário for encontrado, cria a sessão do usuário utilizando a função criar_sessao da classe crtSessao
            crtSessao::criar_sessao($result);
            
            // Inclui a view do menu após o login bem-sucedido
            include("./App/Resources/Views/Tmenu.php");
        }
    } 
?>
