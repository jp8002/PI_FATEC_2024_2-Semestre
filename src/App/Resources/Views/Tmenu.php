<?php
  if(!isset($_SESSION['logado']))      
  {
      header("Location:/");
  }
?>

<!DOCTYPE html>
<html lang="pt_BR">
<head>
    <meta charset="UTF-8">
    <title>Menu</title>
    <link rel="icon" href="PI2V2/App/Resources/imagens/navicon.ico">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/cc7beb20bf.js" crossorigin="anonymous"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
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
            line-height: 30px;
            width: 100%; 
            height: 50px;
            padding: 10px; 
            border-radius: 4px; 
            border: 0px solid #ccc; 
            background-color: #1EE27A; 
            color: #1D3736;
        }
        .green-buttom:hover { 
            background-color: #1ec96d;
            color: white; 
            text-decoration: none;
        }

        
        .red-buttom {
            box-sizing: border-box;
            text-align: center;
            display: block;
            line-height: 30px;
            width: 100%; 
            height: 50px;
            padding: 10px; 
            border-radius: 4px; 
            border: 0px solid #ccc;  
            background-color: #E21E41; 
            color: white;
        }
        .red-buttom:hover{
            background-color: #c01937; 
            color: white;
            text-decoration: none;
        }

        

        .orange-buttom {
            box-sizing: border-box;
            text-align: center;
            display: block;
            line-height: 30px;
            width: 100%; 
            height: 50px;
            padding: 10px; 
            border-radius: 4px; 
            border: 0px solid #ccc; 
            background-color: #F39C36; 
            color: #1D3736;
        }
        .orange-buttom:hover {
            background-color: #d88a31;
            color: white;
            text-decoration: none;
        }
        

        .blue-buttom {
            box-sizing: border-box;
            text-align: center;
            display: block;
            line-height: 30px; 
            width: 100%; 
            height: 50px;
            padding: 10px; 
            border-radius: 4px; 
            border: 0px solid #ccc; 
            background-color: #0E7FBE; 
            color: white;
        }
        .blue-buttom:hover {
            background-color: #0c6ea2;
            color: white;
            text-decoration: none;
        }

        
        .input-base {
            box-sizing: border-box;
            text-align: center;
            display: block;
            line-height: 30px;
            width: 100%; 
            height: 40px;
            padding: 10px; 
            border-radius: 4px; 
            border: 0px solid #ccc; 
            background-color: #D9D9D9; 
            color: black;
        }


        #sino{
            text-decoration: none;
            color: #1D3736;
            padding: 15px 26px;
            position: fixed; bottom: 0; right: 0; width: 100px; height: 50px;;
            display: inline-block;
        }

        #badge{
            background-color: #1EE27A;
            padding: 1px 5px;
            border-radius: 50%;
            position: absolute;
            top: 5px;
            right: 21px;
           
        }

        
    </style>
    
</head>
<center>
<body>

    <div class="wrapper">
    <img src="PI2V2/App/Resources/imagens/dottext.png" alt="erro" style="position: fixed; bottom: 0; left: 0; width: 100px; height: 40px;">

    <br>

    <p style="position: fixed; top: 20px; left: 0;">Usuário: <strong><?php echo htmlspecialchars($_SESSION['usuario']); ?></strong></p>


    <div class="form-group" style="position: fixed; top: 20px; right: 0;">
            <a href="/sair" class="red-buttom">Sair da Conta</a>
            </div>

    <br>     
    <span class="help-block"></span>
    <img src="PI2V2/App/Resources/imagens/almoxarifeicon.png" alt="erro" width="60" height="60">
    
    <h2>SEJA BEM-VINDO</h2>
        <p>O que deseja fazer hoje ?</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            
        <br>

        <div class="form-group">

            <div class="form-group">
            <a href="/Thistorico_devolucao" class="green-buttom">Histórico de Devoluções</a>
            <span class="help-block"></span>
            </div>

           

            <div class="form-group">
            <a href="/Thistorico_saidas" class="green-buttom">Histórico de Saídas</a>
            <span class="help-block"></span>
            </div>


            <div class="form-group">   
            <a href="historico.php" class="green-buttom">Histórico de Entradas e Saídas</a> 
            <span class="help-block"></span>
            </div>

            
            
            <div class="form-group">
            <a href="/Tver_estoque" class="green-buttom">Ver Estoque</a> 
            <span class="help-block"></span>
            </div>
            
           

        <?php if ($_SESSION["tipo_acesso"] === "supervisor") :  ?>
            <div class="form-group">
            <a href="/Tcadastrar_fornecedor" class="green-buttom">Cadastrar Fornecedor</a>
            <span class="help-block"></span>
            </div>

            <div class="form-group">
            <a href="/Tcadastrar_funcionario" class="green-buttom">Cadastrar Funcionário</a>
            <span class="help-block"></span>
            </div>

            <div class="form-group">
            <a href="/Tchecar_avisos" class="orange-buttom">Checar Alertas</a>
            <span class="help-block"></span>
            </div>

            <a id="sino" href="#">
        <span class="fa-regular fa-bell fa-2xl" style="color: white;"></span>
        <span id="badge"></span>
    </a>
    <script src="PI2V2/App/Resources/scripts/script.js"></script>
    
        <?php endif ?>
            
            
        
        <?php if ($_SESSION["tipo_acesso"] === "normal") :  ?>

            <div class="form-group">
            <a href="/Tdevolucao" class="green-buttom">Registrar Devolução</a>
            <span class="help-block"></span>
            </div>

            

            <div class="form-group">
            <a href="/Tregistrar_saida" class="green-buttom">Registrar saída</a>
            <span class="help-block"></span>
            </div>

            

            <div class="form-group">
            <a href="/TadicionarEpi" class="green-buttom">Adicionar E.P.I ao Estoque</a>
            <span class="help-block"></span>
            </div>

            

            <div class="form-group">
            <a href="/Tcompra_epi" class="green-buttom">Registrar Compra </a>
            <span class="help-block"></span>
            </div>

            <div class="form-group">
                <a href="/Tremover_epi.php" class="green-buttom">Remover EPI</a>
                <span class="help-block"></span>
            </div>

            

            <div class="form-group">
            <a href="/Tenviar_aviso" class="orange-buttom">Enviar Alerta</a>
            <span class="help-block"></span>
            </div>

          <?php endif ?>
          </div>


        </form>
    </div>    
</body>
</center>
</html>