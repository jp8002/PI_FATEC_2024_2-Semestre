<?php

require_once('sessao.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $login = $_POST['usuario'];
    $senha = $_POST['senha'];
    $dados = new sessao;
    $dados->cadastrar($_POST['usuario'], $_POST['senha']);
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <title>Acessar</title>
    <link rel="icon" href="img/navicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
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
<center>
<body>
    <div class="wrapper">
    <img src="img/dottext.png" alt="erro" style="position: fixed; bottom: 0; left: 0; width: 100px; height: 40px;">
    <img src="img/loginicon.png" alt="erro" width="90" height="65">
        <h2>CADASTAR</h2>
        <p>Favor inserir usuario e senha.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>USUARIO</label>
                <center>
                <input type="text" name="usuario" id="usuario" class="input-base">
                </center>
                <span class="help-block"></span>
            </div>    
            <div class="form-group">
                <label>SENHA</label>
                <center>
                <input type="password" name="senha" id="senha" class="input-base">
                </center>
                <span class="help-block"></span>
            </div>
            <div class="form-group">
                <center>
                <input type="submit" class="blue-buttom" value="Cadastrar">
                </center>
                <span class="help-block"></span>
            </div>
        </form>
    </div>    
</body>
    </center>

</html>