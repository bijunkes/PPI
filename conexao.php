<?php
    function conecta_db() {
        $servername = 'localhost:3307';
        $username = 'root';
        $password = '';
        $dbname = 'webti';
        return new PDO("myslq:host=$servername;dbname=$dbname", $username, $password);
    }
?>