<?php 
    require_once "controle.php";
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
            display: block;
            text-align: center;
            line-height: 30px;
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
            display: block;
            text-align: center;
            line-height: 30px;
            width: 10%; 
            height: 50px;
            padding: 10px; 
            border-radius: 4px; 
            border: 0px solid #ccc; 
            background-color: #E21E41; 
            color: white;
        }

        .orange-buttom {
            box-sizing: border-box; 
            display: block;
            text-align: center;
            line-height: 30px;
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
            display: block;
            text-align: center;
            line-height: 30px;
            width: 20%; 
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
    <div class="container mt-5">
    <img src="img/devolucao.png" alt="erro" width="80" height="80">
        <h2>Cadastrar Funcionario</h2>
        <img src="img/dottext.png" alt="erro" style="position: fixed; bottom: 0; left: 0; width: 100px; height: 40px;">
        <form action="controle.php" method="post">
            <div class="form-group">
                <label for="funcionarios_retira_id">Nome do Funcionário:</label>
                <input type="text" class="form-control" id="nomeFuncionario" name="nomeFuncionario" required>
            </div>
           
            <button type="submit" class="blue-buttom" name="action" value="cadastrar_funcionario">Registrar</button>
            <br>
            <div class="form-group">
        <a href="menu.php"><button type="button" class="red-buttom" >Voltar</button></a>
        <span class="help-block"></span>
        </div>
        </form>
    </div>
</body>
</html>
