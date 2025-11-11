<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Formulário de Cadastro</h2>
    <form action="" method="get">
        <label for="iname">Nome</label>
        <input type="text" id="iname" name="nome">

        <label for="iemail">Email</label>
        <input type="text" id="iemail" name="email">

        <label for="ipeso">Peso</label>
        <input type="float" id="ipeso" name="peso">

        <label for="ialtura">Altura</label>
        <input type="float" id="ialtura" name="altura">
        
        <input type="submit" value="Cadastrar">
    </form>
    <?php
        if (isset($_GET['nome'], $_GET['email'], $_GET['peso'], $_GET['altura'])) { ?>
            <p>Nome: <?php echo $_GET['nome'] ?></p>
            <p>Email: <?php echo $_GET['email'] ?></p>
            <p>IMC: <?php echo $_GET['peso'] / $_GET['altura'] * $_GET['altura']?></p>
    <?php } ?>
</body>
</html>