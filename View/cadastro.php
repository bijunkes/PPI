<?php
    session_start();
    require_once "../Model/usuarioDao.php";
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['telefone'], $_POST['data_nascimento'])) {
            if (cadastrar($_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['telefone'], $_POST['data_nascimento'])) {
                header("Location: login.php");
                exit();
            } else {
                header("Location: cadastro.php?error=faltando_dados");
                exit();
            }
        }
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
    <header>
        <h1>Cadastro de Usuário</h1>
    </header>
    <form action="cadastro.php" method="post">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" required>
        <br><br>
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required>
        <br><br>
        <label for="senha">Senha:</label>
        <input type="text" id="senha" name="senha" required>
        <br><br>
        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" required>
        <br><br>
        <label for="data_nascimento">Data nascimento:</label>
        <input type="date" id="data_nascimento" name="data_nascimento" required>
        <br><br>
        <input type="submit" value="Cadastrar">
    </form>
</body>
</html>