<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    Minha página HTML
    <?php
        echo "<br>Olá ";
        $nome="Bianca";
        echo $nome;
    ?>
    <h2>Oi</h2>
    <?php
        $a=5;
        $b=7;
        echo "<p>" . $a + $b . "</p>";
    ?>
    <p><?php echo $a+$b ?></p>
    <h2>Operador Ternário</h2>
    <?php
        $nota = 5;
        $situacao = $nota >= 6 ? "aprovado" : "reprovado";
        echo $situacao;
    ?>
    <br/>
    <h2>Array em PHP</h2>
    <?php
        $vetor = array(1, 2, 3, 4, 5);
        for ($i = 0; $i < 5; $i++) {
            echo $vetor[$i] . "<br />";
        }
        foreach($vetor as $elemento) {
            echo  " Elemento :" . $elemento . "<br/>";
        }
    ?>
    <h2>Vetor com índice alfabético</h2>
    <?php
        $vetor = array(
            "nome" => "Bianca",
            "sobrenome" => "Junkes Rech",
            "cpf" => "000.000.000-00"
        );
        echo "Nome: " . $vetor["nome"] . "<br/>";
        echo "Sobrenome: " . $vetor["sobrenome"] . "<br/>";
        echo "CPF: " . $vetor["cpf"] . "<br/>";
    ?>
    <h2>variáveis de ambiente em PHP</h2>
    <?php
        echo "GET: " . $_GET['nome'] . "<br/>";
        echo "SERVER: " . var_dump ($_SERVER);
    ?>
</body>
</html>