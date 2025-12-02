<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $min = $_POST['min'];
        $max = $_POST['max'];
        
        if (is_numeric($min) && is_numeric($max) && $min < $max) {
            $randomNumber = rand($min, $max);
            $message = "O número sorteado é: " . $randomNumber;
        } else {
            $message = "Por favor, insira um intervalo válido.";
        }
    } else {
        $message = "";
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
        <h1>Sorteio</h1>

        <form method="post">
            <label for="min">Mínimo:</label>
            <input type="number" name="min" id="min" required>
            <br><br>
            
            <label for="max">Máximo:</label>
            <input type="number" name="max" id="max" required>
            <br><br>

            <button type="submit">Sortear</button>
        </form>

        <p><?php echo $message; ?></p>

    </body>
</html>
