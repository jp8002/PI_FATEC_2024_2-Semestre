<?php
  if(!isset($_SESSION['logado']))      
  {
      header("Location:/");
  }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <title>Visualizar</title>
</head>
<body>

<div class="container-fluid">

        <div class="mx-auto mt-5 w-50">
            <?php
                
                while ($row = $query->fetch()) {
					if($row["visibilidade"] == 1){
						echo "<ul class='list-group'>";

						echo " <li class='list-group-item d-flex justify-content-between align-items-center btn' data-toggle='collapse' onclick='desativar(". $row['idaviso'] .")' href='#collapse". $row['idaviso'] ."' role='button' aria-expanded='false' aria-controls='collapseExample'>".
								$row['usuario']. " | ". $row['data_aviso'] 
							."</li>"
							;
						
						echo"</ul>";
						
						echo
							"<div class='collapse' id='collapse". $row['idaviso'] ."'>
								<div class='card card-body'>".
									$row['conteudo']
								."</div>
							</div>"
						;

					}
                    
                }
                
                
            ?>
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