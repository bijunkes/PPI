<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Formulário de Cadastro</h2>
    <?php
        if(isset($_SESSION['username'])){
            echo "<p>usuário logado: " . $_SESSION['username'] . "</p>";
        } else {
            header("Location: login.php?error=nao_autenticado");
            exit();
        }

        if(isset($_GET['nome'])){
            $_SESSION['nome'] = $_GET['nome'];
            echo "<h2>Bem vindo, " . $_SESSION['nome'] . "</h2>";
        }

        if (isset($_GET['error']) && $_GET['error'] == 'faltando_dados') {
            echo "<p style='color:red;'>Erro: Por favor, preencha todos os campos.</p>";
        }

        if (isset($_GET['error']) && $_GET['error'] == 'valores_invalidos') {
            echo "<p style='color:red;'>Erro: Por favor, preencha os campos com valores válidos.</p>";
        }
    ?>
    <form action="resultado.php" method="post">
        <label for="iname">Nome</label>
        <input type="text" id="iname" name="nome">

        <label for="iemail">Email</label>
        <input type="text" id="iemail" name="email">

        <label for="ipeso">Peso</label>
        <input type="number" id="ipeso" name="peso" step="0.01">

        <label for="ialtura">Altura</label>
        <input type="number" id="ialtura" name="altura" step="0.01">
        
        <input type="submit" value="Calcular IMC">
    </form>
</body>
</html>