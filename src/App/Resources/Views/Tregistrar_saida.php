<?php
  if(!isset($_SESSION['logado']))      
  {
      header("Location:/");
  }
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Saída</title>
    <link rel="icon" href="PI2V2/App/Resources/imagens/navicon.ico">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
    width: 160px; 
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
    padding: 9px 9px;
    border-radius: 50%;
    position: absolute;
    top: 5px;
    right: 27px;
   
}


    </style>
</head>
<body>
    <div class="container mt-5">
    <img src="PI2V2/App/Resources/imagens/devolucao.png" alt="erro" width="80" height="80">
        <h2>Registrar Saída de EPI</h2>
        <img src="PI2V2/App/Resources/imagens/dottext.png" alt="erro" style="position: fixed; bottom: 0; left: 0; width: 100px; height: 40px;">
        <form action="/retirada_epi" method="post">
            <div class="form-group">
                <label for="funcionarios_retira_id">Selecione o EPI:</label>
                <select class="custom-select" id="inputGroupSelect01 epis" name="epis_id">
                    <option selected hidden>Escolher...</option>
                </select>
            </div>
            <div class="form-group">
                <label for="funcionarios_retira_id">Almoxarife que Entregou:</label>
                <select class="custom-select" id="inputGroupSelect01 almoxarife_id" name="almoxarife_id">
                    <option selected hidden>Escolher...</option>
                </select>
            </div>
            <div class="form-group">
                <label for="funcionarios_retira_id">Funcionario que Retirou:</label>
                <select class="custom-select" id="inputGroupSelect01 idfuncionario" name="idfuncionario">
                    <option selected hidden>Escolher...</option>
                </select>
            </div>
            <div class="form-group">
                <label for="funcionarios_retira_id">Quantidade:</label>
                <input type="number" class="form-control" id="quantidade" name="quantidade" required>
            </div>
           
            <button type="submit" class="blue-buttom" >Registrar Saída</button>
            <br>
            <div class="form-group">
            <a href="Tmenu" type="button" class="red-buttom" >Voltar</a>
        <span class="help-block"></span>
        </div>
        </form>
    </div>
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
        
        fetch('/listar_almoxarife')
        .then(response => response.json())
        .then(data => listar_almoxarife(data))
        

        function listar_almoxarife(response){
            response.forEach(element => {
              console.log(element['usuario']);
              campoei = document.getElementById("inputGroupSelect01 almoxarife_id");
              campoei.innerHTML += '<option value="'+ element['id'] +'">'+ element['usuario'] +'</option>';
          })
        };

        fetch('/listar_funcionarios')
        .then(response => response.json())
        .then(data => listar_funcionarios(data))
        

        function listar_funcionarios(response){
            response.forEach(element => {
              console.log(element['nome_funcionario']);
              campoei = document.getElementById("inputGroupSelect01 idfuncionario");
              campoei.innerHTML += '<option value="'+ element['idfuncionario'] +'">'+ element['nome_funcionario'] +'</option>';
          })
        };
        
</script>
</html>
