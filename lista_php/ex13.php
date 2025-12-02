<?php
    session_start();

    $usuario_valido = 'admin';
    $senha_valida = '1234';

    if (isset($_POST['logout'])) {
        session_destroy();
        exit();
    }

    if (isset($_POST['login'])) {
        $usuario = $_POST['usuario'] ?? '';
        $senha = $_POST['senha'] ?? '';

        if ($usuario === $usuario_valido && $senha === $senha_valida) {
            $_SESSION['usuario'] = $usuario;
        } else {
            $erro = "Usuário ou senha inválidos.";
        }
    }

    $logado = isset($_SESSION['usuario']);
?>

<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
    </head>
    <body>
        <?php if (!$logado): ?>
            <h1>Login</h1>
            <form method="POST" action="">
                <label for="usuario">Usuário:</label>
                <input type="text" name="usuario" id="usuario" required>
                <br><br>
                <label for="senha">Senha:</label>
                <input type="password" name="senha" id="senha" required>
                <br><br>
                <button type="submit" name="login">Entrar</button>
            </form>
            <?php if (isset($erro)): ?>
                <p style="color:red;"><?php echo $erro; ?></p>
            <?php endif; ?>
        <?php else: ?>
            <h1>Bem-vindo.</h1>
            <p>Você está logado.</p>
            <form method="POST" action="">
                <button type="submit" name="logout">Sair</button>
            </form>
        <?php endif; ?>
    </body>
</html>
