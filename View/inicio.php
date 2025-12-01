<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD</title>
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
            padding: 20px;
            border-radius: 10px;
            gap: 2vh;
            width: 20vh;
        }

        button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: #4c7fafff;
            color: white;
            margin: 10px 0;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #4565a0ff;
        }
    </style>
</head>
<body>
    <header>
        <h1>Projeto CRUD</h1>
    </header>
    <div>
        <form action="cadastro.php" method="POST">
            <button type="submit">Cadastrar</button>
        </form>
        
        <form action="login.php" method="POST">
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>
