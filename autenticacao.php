<?php
    if(!isset($_POST['username']) || !isset($_POST['password'])){
        header("Location: login.php?error=faltando_dados");
        exit();
    }
    $username = $_POST['username'];
    $password = $_POST['password'];
    if($username === 'admin' && $password === "123"){
        $_SESSION['username'] = $username;
        echo "<h1>Login sucedido</h1>";
        echo "<p>Bem vindo, $usename</p>";
    }
    else{
        $_SESSION['username'] = NULL;
        header("Location: login.php?error=credenciais_invalidas");
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
    <form action="formulario.php" method="GET">
        <input type="text" name="nome">
        <input type="submit" value="Ir para formulário IMC">
    </form>
    
</body>
</html>