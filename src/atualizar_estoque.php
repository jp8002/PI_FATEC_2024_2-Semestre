<?php
    require_once 'controle.php';
    
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar</title>
    <link rel="icon" href="img/navicon.ico">
    <img src="img/dottext.png" alt="erro" style="position: fixed; bottom: 0; left: 0; width: 100px; height: 40px;">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
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
    
    <form  class="mx-auto mt-5 w-25" action="controle.php" method="post">
    <img src="img/atualizarepi.png" alt="erro" width="70" height="70">
        <h1 >Atualizar estoque</h1>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">EPI</label>
          </div>
          <select class="custom-select" id="inputGroupSelect01 epis" name="epis_id">
            <option selected hidden>Escolher...</option>
          </select>
        </div>
        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <label class="input-group-text" for="inputGroupSelect01">Fornecedor</label>
          </div>
          <select class="custom-select" id="inputGroupSelect01 fornecedor" name="fornecedor_idfornecedor">
            <option selected hidden>Escolher...</option>
          </select>
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <label class="input-group-text" for="data_entrega">data da entrega</label>
          </div>
          <input type="date" name="data_entrega">
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <label class="input-group-text" for="quantidade">quantidade</label>
          </div>
          <input type="number" name="quantidade">
        </div>

        <div class="input-group mb-3">
          <div class="input-group-prepend">
            <label class="input-group-text" for="preco_total">preco total</label>
          </div>
          <input type="number" name="preco_total">
        </div>

        

        <div class="form-group">
        <button type="submit" class="blue-buttom" name="action" value="atualizar">Registrar</button>
        </div>

        <div class="form-group">
        <a href="menu.php" type="button" class="red-buttom"> Voltar</a>
      </div>

    </form>
    
</body>

<script>
        let epis;
        
        console.log("teste");
        $.ajax({
        url:"controle.php",
        type:"POST",
        dataType:"json",
        data:{action:"lista_epi"},
        success:function(response){
            response.forEach(element => {
              console.log(element['nome']);
              campoei = document.getElementById("inputGroupSelect01 epis");
              campoei.innerHTML += '<option value="'+ element['id'] +'">'+ element['nome'] +'</option>';
            });

        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
         } 
        })
        
        $.ajax({
        url:"controle.php",
        type:"POST",
        dataType:"json",
        data:{action:"listar_fornecedor"},
        success:function(response){
            response.forEach(element => {
              console.log(element['nome']);
              campofor = document.getElementById("inputGroupSelect01 fornecedor");
              campofor.innerHTML += '<option value="'+ element['idfornecedor'] +'">'+ element['nome'] +'</option>';
            });

        },
        error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
         } 
        })
        

      

        
</script>
</html>