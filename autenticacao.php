<?php
    session_start();

    if(!isset($_GET['username']) || !isset($_GET['password'])){
        header("Location: login.php?error=faltando_dados");
        exit();
    }

    $username = $_GET['username'];
    $password = $_GET['password'];

    if($username === 'admin' && $password === "123"){
        $_SESSION['username'] = $username;
        echo "<h1>Login sucedido</h1>";
        echo "<p>Bem vindo, $username</p>";
    } else {
        $_SESSION['username'] = NULL;
        header("Location: login.php?error=credenciais_invalidas");
        exit();
    }
?>