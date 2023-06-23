<?php
    include '../dbConfig.php';
    
    $id = $_GET['id'];

    $sql = $pdo->prepare("SELECT * FROM users WHERE id=(?)");
    $sql->execute(array($id));
    $user = $sql->fetch();

    echo($user['username']);
?>