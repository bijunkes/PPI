<?php
    session_start();
    require_once "../Model/usuarioDAO.php";

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    if (!isset($_GET['id'])) {
        header("Location: usuarios.php");
        exit();
    }

    $usuario_id = $_GET['id'];
    
    $usuario = listar_usuario($usuario_id);

    if (!$usuario) {
        header("Location: usuarios.php");
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['excluir'])) {
        if (excluir($usuario_id)) {
            header("Location: usuarios.php");
            exit();
        } else {
            echo "Erro ao excluir o usuário.";
        }
    } else {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $telefone = $_POST['telefone'];
        $data_nascimento = $_POST['data_nascimento'];

        if (editar($usuario_id, $nome, $email, $senha, $telefone, $data_nascimento)) {
            header("Location: usuarios.php");
            exit();
        } else {
            echo "Erro ao atualizar o usuário.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #f4f4f4;
            flex-direction: column;
        }

        header h1 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        
        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #fff;
            border-radius: 10px;
        }

        th, td {
            padding: 12px 20px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #4c7fae;
            color: white;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        a {
            text-decoration: none;
            color: #4c7fae;
            font-weight: bold;
        }

        a:hover {
            color: #4565a0;
        }

        #voltar, button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #4c7fae;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s;
            border: 0
        }

        #excluir {
            background-color: #ac4f4fff;
        }
        #excluir:hover {
            background-color: #a04545ff;
            cursor: pointer;
        }

        #voltar:hover, button:hover {
            background-color: #4565a0;
            cursor: pointer;
        }

        .buttons-container {
            display: flex;
            justify-content: space-between;
            width: 100%;
            margin-top: 20px;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            width: 40vh;
        }

        input[type="text"], input[type="email"], input[type="password"], input[type="date"] {
            padding: 12px;
            margin: 5px 0;
            width: 90%;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Editar Usuário</h1>
    </header>

    <form action="editar.php?id=<?php echo $usuario['id']; ?>" method="POST">
        <label for="nome">Nome:</label>
        <input type="text" id="nome" name="nome" value="<?php echo $usuario['nome']; ?>" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $usuario['email']; ?>" required><br><br>

        <label for="senha">Senha:</label>
        <input type="password" id="senha" name="senha" value="<?php echo $usuario['senha']; ?>" required><br><br>

        <label for="telefone">Telefone:</label>
        <input type="text" id="telefone" name="telefone" value="<?php echo $usuario['telefone']; ?>"><br><br>

        <label for="data_nascimento">Data de Nascimento:</label>
        <input type="date" id="data_nascimento" name="data_nascimento" value="<?php echo $usuario['data_nascimento']; ?>"><br><br>

        <div class="buttons-container">
            <button id="excluir" type="submit" name="excluir" value="1">Excluir</button>
            <button type="submit">Salvar</button>
        </div>
    </form>
    <br><br>
    <a id="voltar" href="usuarios.php">Voltar</a>
</body>
</html>
