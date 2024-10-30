<?php


require 'controle.php';


$query = $almoxarife->ver_entradas();

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/booZtstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <title>Visualizar</title>
</head>
<body>

<div class="container-fluid">

        <div class="mx-auto mt-5 w-50">
            <?php
                echo "<table class='table'>";
                echo "<thead>
                        <tr>
                            <th scope='col'>#</th>
                            <th scope='col'>nome do funcionario</th>
                            <th scope='col'>nome do epi</th>
                            <th scope='col'>data da retirada</th>
                            <th scope='col'>data da devolução</th>
                            <th scope='col'>comentário</th>
                        </tr>
                    </thead>
                    <tbody>";

                while ($row = $query->fetch()) {
                    echo "<tr>
                            <th scope='row'>". $row['id'] ."</th>
                            <td>". $row['nome_funcionario'] ."</td>
                            <td>". $row['nome'] ."</td>
                            <td>". $row['data_retirada'] ."</td>
                            <td>". $row['data_entrada'] ."</td>
                            <td>". $row['comentario'] ."</td>
                        </tr>";
                }

                    
                echo "  </tbody>
                    </table>"; 
                
            ?>
        </div>
        
    </div>

</body>
</html>