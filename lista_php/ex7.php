<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $numero = $_POST['numero'];

        if (is_numeric($numero)) {
            $resultado = [];
            for ($i = 1; $i <= 10; $i++) {
                $resultado[] = "$numero x $i = " . ($numero * $i);
            }
        } else {
            $resultado = ["Por favor, insira um número válido."];
        }
    } else {
        $resultado = [];
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
        <h1>Tabuada</h1>

        <form method="post">
            <label for="numero">Informe um número:</label>
            <input type="number" name="numero" id="numero" required>
            <br><br>

            <button type="submit">Gerar</button>
        </form>

        <?php if (!empty($resultado)): ?>
            <h2>Tabuada de <?php echo $numero; ?>:</h2>
            <ul>
                <?php foreach ($resultado as $linha): ?>
                    <li><?php echo $linha; ?></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

    </body>
</html>
