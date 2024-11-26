<?php

    class Auths{
        public static function validar_post(){

            foreach ($_POST as $i) {
                if($i == ""){
                    return false;
                }
            }   
    
            return true;
    
       }

       
    }