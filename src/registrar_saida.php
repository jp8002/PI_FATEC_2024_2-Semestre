<?php
include 'classes/sessao.php';
require 'controle.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devolução de EPI</title>
    <link rel="icon" href="img/navicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style type="text/css">
        body{ font: 18px sans-serif;
            background-color: #1D3736;
            color:#ffffff
        }

        .wrapper{ width: 350px; padding: 20px; }

        .green-buttom {
            box-sizing: border-box;
            text-align: center;
            display: block;
            width: 100%; 
            height: 50px;
            padding: 10px; 
            border-radius: 4px; 
            border: 0px solid #ccc; 
            background-color: #1EE27A; 
            color: #1D3736;
        }

        .green-buttom:hover {
            box-sizing: border-box;
            text-align: center;
            display: block;
            width: 100%; 
            height: 50px;
            padding: 10px; 
            border-radius: 4px; 
            border: 0px solid #ccc; 
            background-color: #1ec96d; 
            color: #1D3736;
            text-decoration: none;
        }

        .red-buttom:hover{
            box-sizing: border-box;
            text-align: center;
            display: block; 
            width: 100%; 
            height: 50px;
            padding: 10px; 
            border-radius: 4px; 
            border: 0px solid #ccc; 
            background-color: #c01937; 
            color: white;
            text-decoration: none;
        }

        .red-buttom {
            box-sizing: border-box;
            text-align: center;
            display: block; 
            width: 100%; 
            height: 50px;
            padding: 10px; 
            border-radius: 4px; 
            border: 0px solid #ccc;  
            background-color: #E21E41; 
            color: white;
        }

        .orange-buttom {
            box-sizing: border-box;
            text-align: center;
            display: block;
            width: 100%; 
            height: 50px;
            padding: 10px; 
            border-radius: 4px; 
            border: 0px solid #ccc; 
            background-color: #F39C36; 
            color: #1D3736;
        }

        .orange-buttom:hover {
            box-sizing: border-box;
            text-align: center;
            display: block;
            width: 100%; 
            height: 50px;
            padding: 10px; 
            border-radius: 4px; 
            border: 0px solid #ccc; 
            background-color: #d88a31; 
            color: #1D3736;
            text-decoration: none;
        }

        .blue-buttom:hover {
            box-sizing: border-box;
            text-align: center;
            display: block; 
            width: 100%; 
            height: 50px;
            padding: 10px; 
            border-radius: 4px; 
            border: 0px solid #ccc; 
            background-color: #0c6ea2; 
            color: white;
            text-decoration: none;
        }          

        .blue-buttom {
            box-sizing: border-box;
            text-align: center;
            display: block; 
            width: 100%; 
            height: 50px;
            padding: 10px; 
            border-radius: 4px; 
            border: 0px solid #ccc; 
            background-color: #0E7FBE; 
            color: white;
        }

        .input-base {
            box-sizing: border-box;
            text-align: center;
            display: block;
            width: 100%; 
            height: 40px;
            padding: 10px; 
            border-radius: 4px; 
            border: 0px solid #ccc; 
            background-color: #D9D9D9; 
            color: black;
        }


    </style>
</head>
<body>
    <div class="container mt-5">
    <img src="img/devolucao.png" alt="erro" width="80" height="80">
        <h2>Registrar Retirada de EPI</h2>
        <img src="img/dottext.png" alt="erro" style="position: fixed; bottom: 0; left: 0; width: 100px; height: 40px;">
        <form action="controle.php" method="post">
            <div class="form-group">
                <label for="funcionarios_retira_id">ID do EPI:</label>
                <input type="number" class="form-control" id="epis_id" name="epis_id" required>
            </div>
            <div class="form-group">
                <label for="funcionarios_retira_id">ID do almoxarife:</label>
                <input type="number" class="form-control" id="almoxarife_id" name="almoxarife_id" required>
            </div>
            <div class="form-group">
                <label for="funcionarios_retira_id">ID do funcionario:</label>
                <input type="number" class="form-control" id="idfuncionario" name="idfuncionario" required>
            </div>
            <div class="form-group">
                <label for="funcionarios_retira_id">quantidade:</label>
                <input type="number" class="form-control" id="quantidade" name="quantidade" required>
            </div>
           
            <button type="submit" class="blue-buttom" name="action" value="retirada">Registrar retirada</button>
            <br>
            <div class="form-group">
        <a href="menu.php"><button type="button" class="red-buttom" >Voltar</button></a>
        <span class="help-block"></span>
        </div>
        </form>
    </div>
</body>
</html>
