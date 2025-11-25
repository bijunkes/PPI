<?php
    function conecta_db(){
        $servername = "localhost:3307";
        $username = "root";
        $password = "";
        $dbname = "webti";
        return new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    }

    function cadastra_usuario($nome, $email, $senha){
        $con = conecta_db();
        $stmt = $con->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);

        return $stmt->execute();
    }
    cadastra_usuario("b", "b", "123");

    function delete_usuario($id) {
        $con = conecta_db();
        $stmt = $con->prepare("DELETE FROM usuarios WHERE id = :id");

        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
    //delete_usuario(1);
?>