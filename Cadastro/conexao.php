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
   //cadastra_usuario("C", "c@", "123");

    function delete_usuario($id) {
        $con = conecta_db();
        $stmt = $con->prepare("DELETE FROM usuarios WHERE id = :id");

        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }
    //delete_usuario(1);

    function update_usuario($id, $nome, $email, $senha) {
        $con = conecta_db();

        $stmt = $con->prepare("UPDATE usuarios SET nome = :nome, email = :email, senha = :senha WHERE id = :id");

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);

        return $stmt->execute();
    }
    //update_usuario(2, "B", "b@", "123");

    function get_usuario($id) {
        $con = conecta_db();

        $stmt = $con->prepare("SELECT * FROM usuarios WHERE id = :id");

        $stmt->bindParam(':id', $id);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    //var_dump(get_usuario(1));

    function get_usuarios() {
        $con = conecta_db();

        $stmt = $con->prepare("SELECT * FROM usuarios");

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    //var_dump(get_usuarios());
?>