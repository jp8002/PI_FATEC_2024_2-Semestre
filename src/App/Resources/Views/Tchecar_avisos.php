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
    <link rel="icon" href="PI2V2/App/Resources/imagens/navicon.ico">
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
            align-items: center;
            justify-content: center;
            display: flex;
            line-height: 30px;
            width: 500px; 
            height: 70px;
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


        .input-base2 {
            box-sizing: border-box;
            text-align: center;
            display: block;
            line-height: 30px;
            width: 100%; 
            height: 40px;
            padding: 10px; 
            border-radius: 4px; 
            border: 0px solid #ccc; 
            background-color: #ffffff; 
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
    <title>Visualizar Avisos</title>



</head>
<body>
    
<img src="PI2V2/App/Resources/imagens/dottext.png" alt="erro" style="position: fixed; bottom: 0; left: 0; width: 100px; height: 40px;">

<div class="container-fluid">

<form  class="mx-auto mt-5 w-25" "d-flex justify-content:center" method="post">
        <img src="PI2V2/App/Resources/imagens/alerta.png" alt="erro" width="80" height="80">
        <h1>Lista de Avisos</h1>

            <?php
                while ($row = $query->fetch()) {
					if($row["visibilidade"] == 1){
						echo "<ul class='list-group'>";
						echo " <li class='orange-buttom' data-toggle='collapse' onclick='desativar(". $row['idaviso'] .")' href='#collapse". $row['idaviso'] ."' role='button' aria-expanded='false' aria-controls='collapseExample'>".
								$row['usuario']. " | ". $row['data_aviso'] 
							."</li>";

						echo"</ul>";
						
						echo
							"<div class='collapse' style='width:500px' id='collapse". $row['idaviso'] ."'>
								<div class='card card-body' style='color:#000000;'>".
									$row['conteudo']
								."</div>
							</div>"
						;
                        echo "<br>"; 
					}  
                }
                
            ?>
            
            <div class="form-group">
            <a href="/Tmenu" class="red-buttom" >Voltar</a>
        <span class="help-block"></span>
        </div>

        </div>
        
    </div>

</body>

<script>
    function desativar(id){

        $.ajax({
            url: "/desativar_aviso",
            type: "POST",
            dataType: "json",
            data: {idaviso: id},
            success:function(result){
                console.log(result.abc);
            }
        });
    }
</script>
</html>