<?php

    class Auths{ // Declaração da classe Auths, que será responsável por métodos de autenticação e validação.

        // Método estático 'validar_post', responsável por validar os dados recebidos via POST.
        public static function validar_post(){

            // Laço de repetição para percorrer todos os dados no array $_POST.
            foreach ($_POST as $i) {
                // Verifica se algum valor no array $_POST é uma string vazia.
                if($i == ""){
                    // Se encontrar um valor vazio, retorna 'false', indicando que a validação falhou.
                    return false;
                }
            }   
        
            // Se todos os valores no $_POST forem preenchidos, retorna 'true', indicando que a validação foi bem-sucedida.
            return true;
        }

        public static function validar_supervisor($tipo){
            if ($tipo != "supervisor") {
               return false;
            }
            return true;
    }

}