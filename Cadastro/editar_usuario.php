<?php
    session_start();
    require_once "conexao.php";

    if (isset($_GET['id'])) {
        $usuario = get_usuario($_GET['id']);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (update_usuario($_GET['id'], $_POST['nome'], $_POST['email'], $_POST['senha'])) {
            header("Location: lista_usuarios.php?sucs=usuario_atualizado");
            exit();
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Editar Usuário</h1>
    </header>
    <div class="container">
        <form action="editar_usuario.php?id=<?php echo $usuario['id']; ?>" method="post">
            <label for="nome">Nome:</label>
            <input type="text" id="nome" name="nome" value="<?php echo htmlspecialchars($usuario['nome']); ?>" required>
            <br><br>
            <label for="email">Email:</label>
            <input type="text" id="email" name="email"value="<?php echo htmlspecialchars($usuario['email']); ?>" required>
            <br><br>
            <label for="senha">Senha:</label>
            <input type="text" id="senha" name="senha" value="<?php echo htmlspecialchars($usuario['senha']); ?>" required>
            <br><br>
            <input type="submit" value="Editar">
        </form>
    </div>
</body>
</html>