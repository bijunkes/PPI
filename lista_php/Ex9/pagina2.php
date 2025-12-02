<?php
    $nome = $_GET['nome'] ?? '';
    $email = $_GET['email'] ?? '';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Informe seu Peso e Altura</h1>
    <form action="pagina3.php" method="post">
        <input type="hidden" name="nome" value="<?php echo htmlspecialchars($nome); ?>">
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
        
        <label for="peso">Peso (kg):</label>
        <input type="number" name="peso" id="peso" step="0.1" required>
        <br><br>
        
        <label for="altura">Altura (m):</label>
        <input type="number" name="altura" id="altura" step="0.01" required>
        <br><br>

        <button type="submit">Calcular IMC</button>
    </form>
</body>
</html>
