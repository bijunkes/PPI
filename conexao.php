<?php
    function conecta_db(){
        $servername = 'localhost:3307';
        $username = 'root';
        $password = '';
        $dbname = 'webti';
        return new PDO("myslq:host=$servername;dbname=$dbname", $username, $password);
    }

    function cadastra_usuario($nome, $email, $login, $senha){
        $con = conecta_db();
        $stmt = $con->prepare("INSERT INTO usuarios (nome, email, login, senha) VALUES (:nome, :email, :login, :senha)");
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':senha', $senha);
        return $stmt->execute();
    }

    cadastra_usuario("b", "b@", "b", "123");
?>