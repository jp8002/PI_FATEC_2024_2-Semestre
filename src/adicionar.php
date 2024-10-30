<?php
require 'controle.php';
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar</title>
    <link rel="icon" href="img/navicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <style type="text/css">
        body{ font: 18px sans-serif;
            background-color: #1D3736;
            color:#ffffff
        }
        .wrapper{ width: 350px; padding: 20px; }

        .green-buttom {
            box-sizing: border-box; 
            width: 100%; 
            height: 50px;
            padding: 10px; 
            border-radius: 4px; 
            border: 0px solid #ccc; 
            background-color: #1EE27A; 
            color: #1D3736;
        }

        .red-buttom {
            box-sizing: border-box; 
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
            width: 100%; 
            height: 50px;
            padding: 10px; 
            border-radius: 4px; 
            border: 0px solid #ccc; 
            background-color: #F39C36; 
            color: #1D3736;
        }

        .blue-buttom {
            box-sizing: border-box; 
            width: 100px; 
            height: 50px;
            padding: 10px; 
            border-radius: 4px; 
            border: 0px solid #ccc; 
            background-color: #0E7FBE; 
            color: white;
        }

        .input-base {
            box-sizing: border-box; 
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
    
    <form  class="mx-auto mt-5 w-25" action="controle.php" method="post">
    <img src="img/adicionarepi.png" alt="erro" width="70" height="70">
    
        <h1 >Área de Registro</h1>
        <img src="img/dottext.png" alt="erro" style="position: fixed; bottom: 0; left: 0; width: 100px; height: 40px;">
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <label class="input-group-text" for="nome">Nome do EPI</label>
          </div>
          <input type="text" name="nome">
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <label class="input-group-text" for="ca">CA</label>
          </div>
          <input type="number" name="ca">
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <label class="input-group-text" for="unidade">Unidade</label>
          </div>
          <input type="text" name="unidade">
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <label class="input-group-text" for="estoque">Quantidade em estoque</label>
          </div>
          <input type="number" name="estoque">
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <label class="input-group-text" for="minimo">Quantidade mínima</label>
          </div>
          <input type="number" name="minimo">
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <label class="input-group-text" for="validade">Validade</label>
          </div>
          <input type="date" name="validade">
        </div>

        <br>

        <div class="form-group">
        <button type="submit" class="blue-buttom" name="action" value="adicionar" >Registrar</button>
        </div>

        <br>

        <div class="form-group">
            <a href="menu.php" class="red-buttom">Voltar</a>
            </div>

    </form>
    
</body>
</html>