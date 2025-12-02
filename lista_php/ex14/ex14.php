<?php
    function conecta_db() {
        $servername = "localhost:3307";
        $username = "root";
        $password = "";
        $dbname = "banco";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo "Conexão falhou: " . $e->getMessage();
        }
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $nome = $_POST['nome'] ?? '';
        $email = $_POST['email'] ?? '';
        $telefone = $_POST['telefone'] ?? '';

        $conn = conecta_db();

        $sql = "INSERT INTO usuarios (nome, email, telefone) VALUES (:nome, :email, :telefone)";
        $stmt = $conn->prepare($sql);

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telefone', $telefone);

        try {
            if ($stmt->execute()) {
                $mensagem = "Dados inseridos com sucesso!";
            }
        } catch (PDOException $e) {
            $mensagem = "Erro ao inserir dados: " . $e->getMessage();
        }
    }
?>

<!DOCTYPE html>
    <html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Inserção de Dados com PDO</title>
    </head>
    <body>
        <h1>Formulário de Inserção de Dados</h1>

        <?php if (isset($mensagem)): ?>
            <p style="color: <?php echo strpos($mensagem, 'sucesso') !== false ? 'green' : 'red'; ?>">
                <?php echo $mensagem; ?>
            </p>
        <?php endif; ?>

        <form method="POST" action="">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" required><br><br>

            <label for="email">E-mail:</label>
            <input type="email" name="email" id="email" required><br><br>

            <label for="telefone">Telefone:</label>
            <input type="text" name="telefone" id="telefone" required><br><br>

            <button type="submit">Inserir Dados</button>
        </form>
    </body>
</html>
