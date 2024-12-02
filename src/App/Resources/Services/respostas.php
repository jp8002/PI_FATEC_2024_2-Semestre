<?php

    class Respostas{ // Declaração da classe Respostas, que será responsável por exibir mensagens de alerta ou sucesso.

        // Método estático 'lancar_alerta' para exibir uma mensagem de erro.
        public static function lancar_alerta($e){
            echo '<div class="alert alert-danger" role="alert">';
            echo $e;
            echo '</div>';
        }

        // Método estático 'lancar_sucesso' para exibir uma mensagem de sucesso.
        public static function lancar_sucesso($e){
            
            echo '<div class="alert alert-success" role="alert">';
            echo $e;
            echo '</div>';
        }
    }
?>
