<?php

require('conexao.php');

$pdo = new conexao();
$pdo->ver_estoque('');
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

<form  class="mx-auto mt-5 w-25" action="<?php $_PHP_SELF?>" method="post">
        <h1 class="text-center">Lista de estoque</h1>
        

        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <label class="input-group-text" for="curso">EPis</label>
              </div>
              <input type="text" class="form-control" name="pesquisa" values="">
        </div>

        <button type="submit" class="btn btn-primary">pesquisar</button>
        <a href="dash_coor.php"><button type="button" class="btn btn-danger">Voltar</button></a>

</form>

<div class="container-fluid">

        <div class="mx-auto mt-5 w-50">
            <?php
                if ($_SERVER["REQUEST_METHOD"] =="POST"){
                    $pdo->ver_estoque($_POST['pesquisa']);
                }

                echo "<table class='table'>";
                
                echo "<thead>
                        <tr>
                            <th scope='col'>#</th>
                            <th scope='col'>nome</th>
                            <th scope='col'>CA</th>
                            <th scope='col'>Unidade</th>
                            <th scope='col'>Estoque</th>
                            <th scope='col'>minimo</th>
                            <th scope='col'>validade</th>
                        </tr>
                    </thead>
                    <tbody>";

                while ($row = $pdo->stmt->fetch()) {
                    echo "<tr>
                            <th scope='row'>". $row['id'] ."</th>
                            <td>". $row['nome'] ."</td>
                            <td>". $row['CA'] ."</td>
                            <td>". $row['unidade'] ."</td>
                            <td>". $row['estoque'] ."</td>
                            <td>". $row['minimo'] ."</td>
                            <td>". $row['validade'] ."</td>
                        </tr>";
                }

                    
                echo "  </tbody>
                    </table>"; 
                
            ?>
        </div>
        
    </div>

</body>
</html>