<?php
  if(!isset($_SESSION['logado']) || !Auths::validar_supervisor($_SESSION["tipo_acesso"]))      
  {
      header("Location:/");
  }
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrar Compra</title>
    <link rel="icon" href="PI2V2/App/Resources/imagens/navicon.ico">
    <img src="PI2V2/App/Resources/imagens/dottext.png" alt="erro" style="position: fixed; bottom: 0; left: 0; width: 100px; height: 40px;">
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
            width: 90px; 
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
            width: 170px; 
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
    display: inline-block;
    padding: 0.375rem 0.75rem;
    margin-bottom: 0; 
    font-size: 1rem; 
    font-weight: 400;
    line-height: 1.5;
    color: #1D3736; 
    text-align: center; 
    background-color: #1EE27A; 
    border: 1px solid #1EE27A; 
    border-radius: 0.25rem; 
    transition: background-color 0.15s ease-in-out, border-color 0.15s ease-in-out;
        }

    </style>

</head>
<body>

<img src="PI2V2/App/Resources/imagens/dottext.png" alt="erro" style="position: fixed; bottom: 0; left: 0; width: 100px; height: 40px;">

    <form  class="mx-auto mt-5 w-25" action="/comprar_epi" method="post">
    <img src="PI2V2/App/Resources/imagens/compra.png" alt="erro" width="70" height="70">
        <h1>Registrar Compra</h1>


          <div class="form-group">
            <label for="inputGroupSelect01">EPI</label>
          <select class="form-control" id="inputGroupSelect01 epis" name="epis_id">
            <option selected hidden>Escolher...</option>
          </select>
        </div>


          <div class="form-group">
            <label for="inputGroupSelect01">Fornecedor</label>
          <select class="form-control" id="inputGroupSelect01 fornecedor" name="idfornecedor">
            <option selected hidden>Escolher...</option>
          </select>
        </div>

        <div class="form-group">
            <label for="data_entrega">Data da entrega</label>
          <input type="date" class="form-control" name="data_entrega">
        </div>

        <div class="form-group">
            <label for="quantidade">Quantidade</label>
          <input type="number" class="form-control" name="quantidade">
        </div>

        <div class="form-group">
            <label for="preco_total">Preço total</label>
          <input type="number"  class="form-control" name="preco_total">
        </div>

        

        <div class="form-group">
        <button type="submit" class="blue-buttom" >Registrar Compra</button>
        </div>

        <div class="form-group">
        <a href="/Tmenu" type="button" class="red-buttom"> Voltar</a>
      </div>

    </form>
    
</body>

<script>
        let epis;
        
        fetch('/listar_estoque')
        .then(response => response.json())
        .then(data => listar_estoque(data))
        

        function listar_estoque(response){
            response.forEach(element => {
              console.log(element['nome']);
              campoei = document.getElementById("inputGroupSelect01 epis");
              campoei.innerHTML += '<option value="'+ element['id'] +'">'+ element['nome'] +'</option>';
          })
        };

        fetch('/listar_fornecedores')
        .then(response => response.json())
        .then(data => listar_fornecedores(data))
        .catch(error => console.error('Error:', error));
        
       
        function listar_fornecedores(response){
            response.forEach(element => {
              console.log(element['nome']);
              campofor = document.getElementById("inputGroupSelect01 fornecedor");
              campofor.innerHTML += '<option value="'+ element['idfornecedor'] +'">'+ element['nome'] +'</option>';
            });

        };
        
        

      

        
</script>
</html>