<?php
    session_start();
    require_once "../Model/usuarioDAO.php";
    
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
    <title>Cadastro</title>
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

        div {
            display: flex;
            flex-direction: column;
            align-items: center;
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            gap: 1.5rem;
            width: 100%;
            width: 30vh;
        }

        input[type="text"], input[type="date"] {
            padding: 10px;
            margin: 5px 0;
            width: 92%;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        #cadastrar {
            padding: 12px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #4c7fae;
            color: white;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        #cadastrar:hover {
            background-color: #4565a0;
        }

        header h1 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Cadastro de Usuário</h1>
    </header>
    <div>
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
            <input id="cadastrar" type="submit" value="Cadastrar">
        </form>
    </div>
</body>
</html>