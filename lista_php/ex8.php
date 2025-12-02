<?php
    function isPalindrome($str) {
        $str = strtolower(str_replace(' ', '', $str));
        return $str === strrev($str);
    }

    function countVowels($str) {
        $vowels = "aeiouAEIOU";
        $count = 0;
        for ($i = 0; $i < strlen($str); $i++) {
            if (strpos($vowels, $str[$i]) !== false) {
                $count++;
            }
        }
        return $count;
    }

    function countConsonants($str) {
        $consonants = "bcdfghjklmnpqrstvwxyzBCDFGHJKLMNPQRSTVWXYZ";
        $count = 0;
        for ($i = 0; $i < strlen($str); $i++) {
            if (strpos($consonants, $str[$i]) !== false) {
                $count++;
            }
        }
        return $count;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $inputString = $_POST['string'];

        if (!empty($inputString)) {
            $stringLength = strlen($inputString);
            $isPalindrome = isPalindrome($inputString);
            $vowelCount = countVowels($inputString);
            $consonantCount = countConsonants($inputString);
        } else {
            $errorMessage = "Por favor, insira uma string válida.";
        }
    } else {
        $inputString = "";
        $stringLength = $isPalindrome = $vowelCount = $consonantCount = 0;
        $errorMessage = "";
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verificador de String</title>
</head>
<body>
    <h1>Verificador de String</h1>

    <form method="post">
        <label for="string">Informe uma string:</label>
        <input type="text" name="string" id="string" required>
        <br><br>

        <button type="submit">Verificar</button>
    </form>

    <?php if (!empty($inputString)): ?>
        <h2>Resultado para: "<?php echo htmlspecialchars($inputString); ?>"</h2>
        <ul>
            <li>Tamanho: <strong><?php echo $stringLength; ?></strong></li>
            <li>É um palíndromo? <strong><?php echo $isPalindrome ? "Sim" : "Não"; ?></strong></li>
            <li>Número de vogais: <strong><?php echo $vowelCount; ?></strong></li>
            <li>Número de consoantes: <strong><?php echo $consonantCount; ?></strong></li>
        </ul>
    <?php elseif (!empty($errorMessage)): ?>
        <p style="color: red;"><?php echo $errorMessage; ?></p>
    <?php endif; ?>

</body>
</html>
