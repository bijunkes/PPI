<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $lado1 = $_POST['lado1'];
        $lado2 = $_POST['lado2'];
        $lado3 = $_POST['lado3'];

        if (($lado1 + $lado2 > $lado3) && ($lado1 + $lado3 > $lado2) && ($lado2 + $lado3 > $lado1)) {
            
            if ($lado1 == $lado2 && $lado2 == $lado3) {
                $tipo = "Equilátero";
            } elseif ($lado1 == $lado2 || $lado1 == $lado3 || $lado2 == $lado3) {
                $tipo = "Isósceles";
            } else {
                $tipo = "Escaleno";
            }
            
            echo "<h2>Triângulo válido.</h2>";
            echo "<p>O triângulo é: " . $tipo . "</p>";
        } else {
            echo "<h2>Erro: Os valores fornecidos não formam um triângulo válido.</h2>";
        }
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
        <h1>Classificação Triângulo</h1>
        <form method="post">
            <label for="lado1">Lado 1:</label>
            <input type="number" name="lado1" id="lado1" required>
            <br><br>
            <label for="lado2">Lado 2:</label>
            <input type="number" name="lado2" id="lado2" required>
            <br><br>
            <label for="lado3">Lado 3:</label>
            <input type="number" name="lado3" id="lado3" required>
            <br><br>
            <button type="submit">Verificar Triângulo</button>
        </form>
    </body>
</html>
