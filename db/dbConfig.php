<?php
    $pdo = new PDO("mysql:host=localhost;dbname=to-do-list-db", "root" ,"0000");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
?>