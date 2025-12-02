<?php
    $nome = $_POST['nome'] ?? '';
    $email = $_POST['email'] ?? '';
    $peso = $_POST['peso'] ?? 0;
    $altura = $_POST['altura'] ?? 0;

    if ($peso > 0 && $altura > 0) {
        $imc = $peso / ($altura * $altura);
        $imc_formatado = number_format($imc, 2, ',', '.');
    } else {
        $imc_formatado = 'Dados inválidos';
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
        <h1>Resultado IMC</h1>

        <p><strong>Nome:</strong> <?php echo htmlspecialchars($nome); ?></p>
        <p><strong>E-mail:</strong> <?php echo htmlspecialchars($email); ?></p>
        <p><strong>Peso:</strong> <?php echo $peso; ?> kg</p>
        <p><strong>Altura:</strong> <?php echo $altura; ?> m</p>
        <p><strong>IMC:</strong> <?php echo $imc_formatado; ?></p>

        <h2>Classificação IMC:</h2>
        <p>
            <?php
            if ($imc < 18.5) {
                echo "Abaixo do peso";
            } elseif ($imc >= 18.5 && $imc < 24.9) {
                echo "Peso normal";
            } elseif ($imc >= 25 && $imc < 29.9) {
                echo "Sobrepeso";
            } elseif ($imc >= 30 && $imc < 34.9) {
                echo "Obesidade grau 1";
            } elseif ($imc >= 35 && $imc < 39.9) {
                echo "Obesidade grau 2";
            } else {
                echo "Obesidade grau 3";
            }
            ?>
        </p>

    </body>
</html>
