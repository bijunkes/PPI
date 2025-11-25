<?php
    if(!isset($_POST['nome']) || !isset($_POST['email']) || !isset($_POST['senha'])){
        header("Location: login.php?error=faltando_dados");
        exit();
    }

    session_start();
    require_once "conexao.php";
    
    cadastra_usuario($_POST['nome'], $_POST['email'], $_POST['senha']);

    header("Location: lista_usuarios.php?sucs")
?>
