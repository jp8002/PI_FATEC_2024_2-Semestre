<?php

require('cabeca.php');

$usuario = $_SESSION['usuario'];

?>

<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <title>Menu</title>
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
    

    <br>

    <p style="position: fixed; top: 20px; left: 0;">Usuário: <strong><?php echo htmlspecialchars($usuario); ?></strong></p>


    <div class="form-group" style="position: fixed; top: 20px; right: 0;">
            <a href="sair.php" class="red-buttom">Sair da Conta</a>
            </div>

    <br>     
    <span class="help-block"></span>
    <img src="img/almoxarifeicon.png" alt="erro" width="60" height="60">
    
    <h2>SEJA BEM-VINDO</h2>
        <p>O que deseja fazer hoje ?</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            
        <br>

        <div class="form-group">

            <div class="form-group">
            <a href="historico_entradas.php" class="green-buttom">Histórico de Entradas</a>
            <span class="help-block"></span>
            </div>

            <br>

            <div class="form-group">
            <a href="historico_saidas.php" class="green-buttom">Histórico de Saídas</a>
            <span class="help-block"></span>
            </div>

            <br>

            <div class="form-group">   
            <a href="historico.php" class="green-buttom">Histórico de Entradas e Saídas</a> 
            <span class="help-block"></span>
            </div>

            <br>
            
            <div class="form-group">
            <a href="ver_estoque.php" class="green-buttom">Ver Estoque</a> 
            <span class="help-block"></span>
            </div>
            
            <br>

        <?php if ($usuario === "supervisor") :  ?>
            <div class="form-group">
            <a href="checar_alertas.php" class="orange-buttom">Checar Alertas</a>
            <span class="help-block"></span>
            </div>
        <?php endif ?>
            
            
        
          <?php if ($usuario === "almoxarife") :  ?>

            <div class="form-group">
            <a href="registrar_entrada.php" class="green-buttom">Registrar Entrada</a>
            <span class="help-block"></span>
            </div>

            <br>

            <div class="form-group">
            <a href="registrar_saida.php" class="green-buttom">Registrar saída</a>
            <span class="help-block"></span>
            </div>

            <br>

            <div class="form-group">
            <a href="adicio_teste.php" class="green-buttom">Adicionar E.P.I ao Estoque</a>
            <span class="help-block"></span>
            </div>

            <br>

            <div class="form-group">
            <a href="atualizar_estoque.php" class="green-buttom">Atualizar Estoque</a>
            <span class="help-block"></span>
            </div>

            <br>

            <div class="form-group">
            <a href="enviar_alerta.php" class="orange-buttom">Enviar Alerta</a>
            <span class="help-block"></span>
            </div>

          <?php endif ?>
          </div>


        </form>
    </div>    
</body>
</center>
</html>