<?php

    // Define a classe CrtSessao, que contém métodos para gerenciar sessões de usuários
    class CrtSessao{
        
        // Método estático para criar uma sessão de usuário
        public static function criar_sessao($resultado){
            
            // Verifica se a senha fornecida pelo usuário é válida comparando com a senha armazenada no banco
            if (password_verify($_POST['senha'], $resultado["senha"])){
                // Se a senha for válida, cria a sessão e armazena informações do usuário
                $_SESSION ['logado'] = TRUE;  // Define a chave 'logado' como TRUE, indicando que o usuário está autenticado
                $_SESSION ['usuario'] = $_POST['login'];  // Armazena o nome do usuário na sessão
                $_SESSION ['almoxarife_id'] = $resultado['id'];  // Armazena o ID do almoxarife na sessão
                $_SESSION["tipo_acesso"] = $resultado["tipo"];  // Armazena o tipo de acesso do usuário

                return TRUE;  // Retorna TRUE indicando que a sessão foi criada com sucesso
            }
            else {
                // Se a senha não for válida, exibe uma mensagem de erro
                echo 'senha errada';
                session_destroy();  // Destrói a sessão atual
                return FALSE;  // Retorna FALSE indicando que a autenticação falhou
            }
        }

        // Método estático para sair (encerrar a sessão do usuário)
        public static function sair(){
            
            // Limpa todas as variáveis de sessão
            $_SESSION = array();
            // Destroi a sessão
            session_destroy();
            // Redireciona o usuário para a página de login
            header("location: /");
        }
    }    
?>
