<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Cadastro de Usuário</h1>
        <nav>links</nav>
    </header>
    <div class="container">
        <form action="processa_cadastro.php" method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" required>
            <br><br>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>
            <br><br>
            <label for="senha">Senha:</label>
            <input type="text" id="senha" name="senha" required>
            <br><br>
            <input type="submit" value="Cadastrar">
        </form>
    </div>
</body>
</html>