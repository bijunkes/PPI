<?php
    if (!isset($_POST['peso']) || !isset($_POST['altura']) || empty($_POST['peso']) || empty($_POST['altura'])) {
        header("Location: formulario.php?error=faltando_dados");
        exit();
    }
    if (!is_numeric($_POST['peso']) || !is_numeric($_POST['altura']) || $_POST['altura'] <= 0 || $_POST['peso'] <= 0) {
        header("Location: formulario.php?error=valores_invalidos");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p>Nome: <?php echo $_POST['nome'] ?></p>
    <p>Email: <?php echo $_POST['email'] ?></p>
    <p>Peso: <?php echo $_POST['peso'] ?></p>
    <p>Altura: <?php echo $_POST['altura'] ?></p>
    <p>IMC: <?php echo round(($_POST['peso'] / ($_POST['altura'] * $_POST['altura'])), 2)?></p>
</body>
</html>
