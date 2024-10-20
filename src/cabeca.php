<?php
    require_once('sessao.php'); 
    $dados = new sessao;
    if (!$dados->conta_logada()) {
        header("location: login.php");
        exit;
    };
?>