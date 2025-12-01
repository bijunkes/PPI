<?php
    require_once "../conexao.php";

    function cadastrar($nome, $email, $senha, $telefone, $data_nascimento){
        $con = conecta_db();
        $stmt = $con->prepare("INSERT INTO usuarios (nome, email, senha, telefone, data_nascimento) VALUES (:nome, :email, :senha, :telefone, :data_nascimento)");

        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':data_nascimento', $data_nascimento);

        return $stmt->execute();
    }

    function logar($email, $senha) {
        $con = conecta_db();
        
        $stmt = $con->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($usuario && $senha === $usuario['senha']) {
            $_SESSION['user_id'] = $usuario['id'];
            $_SESSION['user_name'] = $usuario['nome'];
            $_SESSION['user_email'] = $usuario['email'];
            
            return true;
        }
        
        return false;
    }


    function excluir($id) {
        $con = conecta_db();
        $stmt = $con->prepare("DELETE FROM usuarios WHERE id = :id");

        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    function editar($id, $nome, $email, $senha, $telefone, $data_nascimento) {
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

    function listar_usuario($id) {
        $con = conecta_db();

        $stmt = $con->prepare("SELECT * FROM usuarios WHERE id = :id");

        $stmt->bindParam(':id', $id);

        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    function listar_usuarios() {
        $con = conecta_db();

        $stmt = $con->prepare("SELECT * FROM usuarios");

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
?>