<?php
include 'classes/sessao.php';
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Devolução de EPI</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Registrar Devolução de EPI</h2>
        <form action="controle.php" method="post">
            <div class="form-group">
                <label for="funcionarios_retira_id">ID da Retirada:</label>
                <input type="number" class="form-control" id="funcionarios_retira_id" name="funcionarios_retira_id" required>
            </div>
            <div class="form-group">
                <label for="comentario">Comentário (opcional):</label>
                <textarea class="form-control" id="comentario" name="comentario"  placeholder="Comentário"></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="action" value="devolucao">Registrar Devolução</button>
        </form>
    </div>
</body>
</html>
