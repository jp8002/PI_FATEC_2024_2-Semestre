<?php

class sessao {

    //Criando função de logar
public function logar ($login, $senha){
    session_start();
    if ($login == 'almoxarife' and $senha == 'almoxarife' or $login == 'supervisor' and $senha == 'supervisor'  ){
        $_SESSION ['logado'] = TRUE;
        $_SESSION ['usuario'] = $login;
        return TRUE;
    }

    else {
        
        $_SESSION ['logado'] = FALSE;
        return FALSE;
    }
}

//Criando função de sair
public function sair(){
session_start();
$_SESSION = array();
session_destroy();
}

//Criando função de conta logada
public function conta_logada () {
    session_start();
    if(!isset($_SESSION["logado"]) || $_SESSION["logado"] !== true){
        return FALSE;
    }
    return TRUE;
}

}