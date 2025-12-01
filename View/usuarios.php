<?php
    session_start();
    require_once "../Model/usuarioDAO.php";

    if (!isset($_SESSION['user_id'])) {
        header("Location: login.php");
        exit();
    }

    $usuarios = listar_usuarios();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuários</title>
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

        #voltar {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4c7fae;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 16px;
            transition: background-color 0.3s;
        }

        #voltar:hover {
            background-color: #4565a0;
        }
    </style>
</head>
<body>
    <header>
        <h1>Lista de Usuários</h1>
    </header>

    <?php if (count($usuarios) > 0): ?>
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>  <!-- Nova coluna -->
                <th>Data de Nascimento</th>  <!-- Nova coluna -->
                <th>Ações</th>
            </tr>
            <?php foreach ($usuarios as $usuario): ?>
                <tr>
                    <td><?php echo $usuario['id']; ?></td>
                    <td><?php echo $usuario['nome']; ?></td>
                    <td><?php echo $usuario['email']; ?></td>
                    <td><?php echo $usuario['telefone']; ?></td>  <!-- Exibe o telefone -->
                    <td><?php echo $usuario['data_nascimento']; ?></td>  <!-- Exibe a data de nascimento -->
                    <td>
                        <a href="editar.php?id=<?php echo $usuario['id']; ?>">Editar</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php else: ?>
            <p>Não há usuários cadastrados.</p>
        <?php endif; ?>
    <a id="voltar" href="inicio.php">Voltar</a>
</body>
</html>
