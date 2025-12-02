Bianca Junkes Rech - I6

CRUD em PHP
Abaixo do nome de cada arquivo, explico sua principal funcionalidade. Ao longo de cada código, explico a lógica utilizada em cada escolha por meio de comentários.

-----------------------------------------------------------------------------------------------
db.sql
Criação do banco de dados. Me baseei no projeto protótipo do professor.

CREATE DATABASE IF NOT EXISTS `crud` DEFAULT CHARSET utf8 COLLATE utf8_general_ci;
GRANT ALL PRIVILEGES ON crud_ppi.* TO 'user'@'%';
FLUSH PRIVILEGES;
USE `crud`;

CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
  `nome` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `senha` VARCHAR(255) NOT NULL,
  `telefone` VARCHAR(15) NOT NULL,
  `data_nascimento` DATE NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

------------------------------------------------------------------------------------------------
conexão.php
Arquivo responsável por configurar o acesso ao banco de dados, utilizado no usuarioDAO.

<?php
    function conecta_db(){
        $servername = "localhost:3307";
        $username = "root";
        $password = "";
        $dbname = "crud";
        return new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    }
?>

------------------------------------------------------------------------------------------------
usuarioDAO.php
Nesse arquivo, estão estruturados os métodos que fazem requisições ou recebem dados do banco.
Como a maioria dos métodos funcionam pela mesma lógica, explicarei mais detalhadamente somente o primeiro.

<?php
    require_once "../conexao.php"; //Importa o arquivo da conexão

    function cadastrar($nome, $email, $senha, $telefone, $data_nascimento){ //Recebe parâmetros para cadastrar um usuário
        $con = conecta_db(); //Instância do método para conectar ao banco
        $stmt = $con->prepare("INSERT INTO usuarios (nome, email, senha, telefone, data_nascimento) VALUES (:nome, :email, :senha, :telefone, :data_nascimento)"); //Instância de uma consulta SQL

	//Dados passados à consulta
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':data_nascimento', $data_nascimento);

        return $stmt->execute(); //Retorno da consulta
    }

    function logar($email, $senha) { //Recebe parâmetros para logar um usuário
        $con = conecta_db();
        
        $stmt = $con->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC); //Retorna o resultado da requisição em formato de array.
        
        if ($usuario && $senha === $usuario['senha']) { //Caso usuário e senha sejam preenchidos e a senha corresponder...
            $_SESSION['user_id'] = $usuario['id'];
            $_SESSION['user_name'] = $usuario['nome'];
            $_SESSION['user_email'] = $usuario['email'];
            
            return true; //Retorna usuário logado
        }
        
        return false; //Usuário não existente ou dados incorretos
    }

    function excluir($id) { //Recebe o id do usuário para excluí-lo
        $con = conecta_db();
        $stmt = $con->prepare("DELETE FROM usuarios WHERE id = :id");

        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    function editar($id, $nome, $email, $senha, $telefone, $data_nascimento) { //Recebe parâmetros do usuário para editá-los
        $con = conecta_db();

        $stmt = $con->prepare("UPDATE usuarios SET nome = :nome, email = :email, senha = :senha, telefone = :telefone, data_nascimento = :data_nascimento WHERE id = :id");

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':data_nascimento', $data_nascimento);

        return $stmt->execute();
    }

    function listar_usuario($id) { //Recebe o id do usuário listá-lo
        $con = conecta_db();

        $stmt = $con->prepare("SELECT * FROM usuarios WHERE id = :id");

        $stmt->bindParam(':id', $id);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); //Retorna o resultado da requisição em formato de array. Ex: ["id" => 1]
    }

    function listar_usuarios() { //Não recebe nenhum parâmetro, apenas faz uma consulta de todos os usuários sem filtro no banco
        $con = conecta_db();

        $stmt = $con->prepare("SELECT * FROM usuarios");

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC); //Retorna todos os resultados da requisição em formato de array

    }
?>

------------------------------------------------------------------------------------------------
index.php
Arquivo padrão renderizado pela requisição HTTP. Redireciona para a view "inicio".

<?php
    include_once (__DIR__."/View/inicio.php");
?>

------------------------------------------------------------------------------------------------
inicio.php
View inicial. Aqui o usuário escolhe entre cadastrar ou entrar.

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
        <form action="/view/cadastro.php" method="POST"> <!-- Método POST. Aqui utilizado para fazer um requisição para ir à view "cadastro" ao submeter o formulário -->
            <button type="submit">Cadastrar</button>
        </form>
        
        <form action="/view/login.php" method="POST"> <!-- Método POST. Aqui utilizado para fazer um requisição para ir à view "login" ao submeter o formulário -->
            <button type="submit">Entrar</button>
        </form>
    </div>
</body>
</html>

------------------------------------------------------------------------------------------------
cadastro.php
Arquivo responsável por cadastrar usuários.

<?php
    session_start();
    require_once "../Model/usuarioDAO.php"; //Importação de métodos criados no usuarioDAO
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') { //Método POST. Aqui utilizado para fazer uma requisição, a qual fornecerá os dados dos campos preenchidos para cadastrar usuários
        if (isset($_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['telefone'], $_POST['data_nascimento'])) { //Caso todos as variáveis estejam declaradas, ou seja, diferentes de null, prosseguir com a requisição
            if (cadastrar($_POST['nome'], $_POST['email'], $_POST['senha'], $_POST['telefone'], $_POST['data_nascimento'])) { //Caso o cadastro seja bem-sucedido, redirecionar à view "login"
                header("Location: login.php");
                exit();
            } else {
                header("Location: cadastro.php?error=faltando_dados"); //Caso o cadastro não seja bem-sucedido, redirecionar à url que informe o erro, nesse caso "faltando dados"
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
       <form action="cadastro.php" method="post"> <!-- Método POST. Informa que ao submeter o formulário, dados serão enviados por meio de uma requisição HTTP que irá tratá-los por meio do código em PHP acima, que utiliza o método "cadastrar" criado no usuarioDAO para armazenar dados no banco -->
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

------------------------------------------------------------------------------------------------
login.php
Arquivo responsável por logar usuários.

<?php
    session_start();
    require_once "../Model/usuarioDAO.php"; //Importação de métodos criados no usuarioDAO

    if ($_SERVER['REQUEST_METHOD'] === 'POST') { //Método POST. Aqui utilizado para fazer uma requisição, a qual fornecerá os dados dos campos preenchidos para logar usuários
        if (isset($_POST['email'], $_POST['senha'])) { //Caso todos as variáveis estejam declaradas, ou seja, diferentes de null, prosseguir com a requisição

            $email = $_POST['email'];
            $senha = $_POST['senha'];
            
            if (logar($email, $senha)) { //Método logar. Aqui utilizado para verificar se os dados submetidos encontram-se no banco. Caso sejam encontrados, o usuário é redirecionado à view "usuarios"
                header("Location: usuarios.php");
                exit();
            } else {
                header("Location: login.php?error=invalid_credentials"); //Caso o login não seja bem-sucedido, redirecionar à url que informe o erro, nesse caso "credenciais inválidas"
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
    <title>Login</title>
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

        input[type="text"] {
            padding: 10px;
            margin: 5px 0;
            width: 92%;
            border-radius: 5px;
            border: 1px solid #ccc;
            font-size: 14px;
        }

        #entrar {
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

        #entrar:hover {
            background-color: #4565a0;
        }

        header h1 {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Login de Usuário</h1>
    </header>
    <div>
        <form action="login.php" method="POST"> <!-- Método POST. Informa que ao submeter o formulário, dados serão enviados por meio de uma requisição HTTP que irá tratá-los por meio do código em PHP acima, que utiliza o método "logar" criado no usuarioDAO para selecionar/verificar dados no banco -->
        <label for="email">Email:</label>
        <input type="text" id="email" name="email" required>
        <br><br>
        <label for="senha">Senha:</label>
        <input type="text" id="senha" name="senha" required>
        <br><br>
        <input id="entrar" type="submit" value="Entrar">
    </form>
    </div>
</body>
</html>

------------------------------------------------------------------------------------------------
usuarios.php
Arquivo responsável por listar todos os usuários cadastrados no banco, incluindo respectivos dados.

<?php
    session_start();
    require_once "../Model/usuarioDAO.php"; //Importação de métodos criados no usuarioDAO

    if (!isset($_SESSION['user_id'])) { //Caso o id do usuário não seja recebido na requisição POST pela sessão, voltar à página "login"
        header("Location: login.php");
        exit();
    }

    $usuarios = listar_usuarios(); //Variável que armazena todos os usuários por meio do método "listar_usuarios()" criado no arquivo usuarioDAO
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

    <?php if (count($usuarios) > 0): ?> <!-- Caso existam usuários cadastrados -->
        <table>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Email</th>
                <th>Telefone</th>
                <th>Data de Nascimento</th>
                <th>Ações</th>
            </tr>
            <?php foreach ($usuarios as $usuario): ?> <!-- Para cada usuário cadastrado, mostrar respectivos dados por meio do php echo que renderiza dados na tela -->
                <tr>
                    <td><?php echo $usuario['id']; ?></td>
                    <td><?php echo $usuario['nome']; ?></td>
                    <td><?php echo $usuario['email']; ?></td>
                    <td><?php echo $usuario['telefone']; ?></td>
                    <td><?php echo $usuario['data_nascimento']; ?></td>
                    <td>
                        <a href="editar.php?id=<?php echo $usuario['id']; ?>">Editar</a> <!-- Para cada usuário cadastrado, fornecer a opção de editá-lo -->
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <?php else: ?> <!-- Caso não existam usuários cadastrados, informar uma mensagem de lista vazia -->
            <p>Não há usuários cadastrados.</p>
        <?php endif; ?>
    <a id="voltar" href="inicio.php">Voltar</a> <!-- Opção para voltar a página inicial -->
</body>
</html>

------------------------------------------------------------------------------------------------
editar.php
Arquivo responsável por editar dados do usuário ou excluí-lo.

<?php
    session_start();
    require_once "../Model/usuarioDAO.php"; //Importação de métodos criados no usuarioDAO

    if (!isset($_SESSION['user_id'])) { //Caso o id do usuário não seja recebido na requisição POST pela sessão, voltar à página "login"
        header("Location: login.php");
        exit();
    }

    if (!isset($_GET['id'])) { //Caso não seja encontrado o id do usuário da lista de usuários fornecido pela sessão anterior, voltar à view "usuarios"
        header("Location: usuarios.php");
        exit();
    }

    $usuario_id = $_GET['id']; //Caso seja encontrado o id do usuário da lista de usuários fornecido pela sessão anterior, armazena-o em uma variável
    
    $usuario = listar_usuario($usuario_id); //Passa o id do usuário encontrado como parâmetro do método "listar_usuario" criado no arquivo "usuarioDAO" o qual lista todos os atributos de um único usuário a partir de seu id

    if (!$usuario) { //Caso o usuário não exista, voltar à "usuarios"
        header("Location: usuarios.php");
        exit();
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') { //Caso seja feito uma requisição POST à sessão...
    if (isset($_POST['excluir'])) { //Verificar se a requisição é excluir
        if (excluir($usuario_id)) { //Caso usuário seja excluído com sucesso, voltar à view "usuarios"
            header("Location: usuarios.php");
            exit();
        } else { //Caso a exclusão não seja bem-sucedida, informar erro
            echo "Erro ao excluir o usuário.";
        }
    } else { //Verificar se a requisição é outra além de excluir, nesse caso a única outra possível nesse arquivo seria a de editar
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        $telefone = $_POST['telefone'];
        $data_nascimento = $_POST['data_nascimento'];

        if (editar($usuario_id, $nome, $email, $senha, $telefone, $data_nascimento)) { //Se todos os dados forem fornecidos e capturados pelo POST, então chamar o método editar e passar todos os atributos capturados como parâmetros de edição. Logo em seguida, redirecionar para a página "usuarios"
            header("Location: usuarios.php");
            exit();
        } else { //Caso não seja possível editar o usuário por algum erro, informar que não foi possível editá-lo
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

    <form action="editar.php?id=<?php echo $usuario['id']; ?>" method="POST"> <!-- Método POST. Informa que ao submeter o formulário, dados serão enviados por meio de uma requisição HTTP que irá tratá-los por meio do código em PHP acima, que utiliza os métodos "editar" e "excluir" criados no usuarioDAO para editar e excluir dados no banco. Aqui também é passado o id do usuário à requisição, pois assim o usuário será encaminhado para a página de edição correta e garantir que o usuário editado é o escolhido -->
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

        <div class="buttons-container"> <!-- Ambos botões de submissão, para diferenciá-los usei essa linha que verifica se o método escolhido é excluir no código PHP acima: (isset($_POST['excluir'])). -->
            <button id="excluir" type="submit" name="excluir" value="1">Excluir</button>
            <button type="submit">Salvar</button>
        </div>
    </form>
    <br><br>
    <a id="voltar" href="usuarios.php">Voltar</a> <!-- Caso queira voltar à página anterior sem fazer nenhuma requisição -->
</body>
</html>
