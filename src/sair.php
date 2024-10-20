<?php
    require_once('sessao.php'); 
    $dados = new Sessao;
    $dados->sair();
    header("location: login.php");
exit;
?>