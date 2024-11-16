<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/cc7beb20bf.js" crossorigin="anonymous"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</head>
<body>
    

    <div class="dropdown">
    <a id="sino" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <span class="fa-solid fa-inbox fa-2xl" style="color: black;"></span>
        <span id="badge"></span>
    </a>
        <div class="dropdown-menu" id="dropdown-menu" aria-labelledby="dropdownMenuLink">
            
        </div>
    </div>
</body>

    <script>
        let epi;

        setInterval(contar_alertas,2000);

        function contar_alertas(){
            $.ajax({
                url:"controle.php",
                type:"POST",
                dataType:"json",
                data:{action:"alerta"},
                success(response){
                    epi =response;

                    //console.log(epi);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown);
                }

            })

           let dropdown = document.getElementById("dropdown-menu");
           dropdown.innerHTML = '';
           epi.forEach(element =>{
                console.log(element["nome"]);
                dropdown.innerHTML += '<a class=dropdown-item" > O EPI : '+ element["nome"] +' está abaixo da quantidade mínima '+ element["minimo"] + '</a><br>';
           });
           
        }
        
    </script>
</html>