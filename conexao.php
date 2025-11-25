<?php
    function conecta_db(){
        $servername = "localhost:3307";
        $username = "root";
        $password = "";
        $dbname = "crud";
        return new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    }
?>