<?php
    if (isset($_GET['inicio']) && isset($_GET['fim'])) {
        $inicio = $_GET['inicio'];
        $fim = $_GET['fim'];

        if ($inicio <= $fim) {
            $numeros = range($inicio, $fim);
        } else {
            $numeros = [];
            $erro = "O número inicial deve ser menor ou igual ao número final.";
        }
    } else {
        $numeros = [];
    }
?>

<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <style>
            .numero {
                display: inline-block;
                margin: 5px;
                padding: 10px;
                background-color: #f2f2f2ff;
                border: 1px solid #ccccccff;
                border-radius: 5px;
                font-size: 18px;
                color: #333333ff;
            }
            .erro {
                color: red;
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <h1>Defina Intervalo de Números</h1>

        <form method="get">
            <label for="inicio">Número Inicial:</label>
            <input type="number" name="inicio" id="inicio" required>
            <br><br>
            <label for="fim">Número Final:</label>
            <input type="number" name="fim" id="fim" required>
            <br><br>
            <button type="submit">Exibir Intervalo</button>
        </form>

        <?php if (isset($erro)): ?>
            <p class="erro"><?php echo $erro; ?></p>
        <?php endif; ?>

        <?php if (!empty($numeros)): ?>
            <h2>Intervalo de <?php echo $inicio; ?> a <?php echo $fim; ?>:</h2>
            <div>
                <?php foreach ($numeros as $numero): ?>
                    <span class="numero"><?php echo $numero; ?></span>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </body>
</html>
