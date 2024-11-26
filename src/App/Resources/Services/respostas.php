<?php

    class Respostas{
        public static function lancar_alerta($e){
            echo '<div class="alert alert-danger" role="alert">';
            echo $e;
            echo '</div>';
        }

        public static function lancar_sucesso($e){
            echo '<div class="alert alert-success" role="alert">';
            echo $e;
            echo '</div>';
        }
    }