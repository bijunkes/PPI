<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $numero = $_POST['numero'];
        
        if (is_numeric($numero)) {
            if ($numero % 2 == 0) {
                $resultado = "Par";
            } else {
                $resultado = "Ímpar";
            }
        } else {
            $resultado = "Por favor, insira um número válido.";
        }
    } else {
        $resultado = "";
    }
?>

<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <h1>Par ou Ímpar</h1>

        <form method="post">
            <label for="numero">Informe um número:</label>
            <input type="number" name="numero" id="numero" required>
            <br><br>

            <button type="submit">Verificar</button>
        </form>

        <?php if ($resultado != ""): ?>
            <p>O número informado foi: <strong><?php echo $numero; ?></strong></p>
            <p>Resultado: <strong><?php echo $resultado; ?></strong></p>
        <?php endif; ?>

    </body>
</html>
