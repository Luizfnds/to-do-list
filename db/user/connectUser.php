<?php
    include '../dbConfig.php';
    
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = $pdo->prepare("SELECT * FROM users WHERE username = (?)");
    $sql->execute(array($username));
    $user = $sql->fetch();

    if(!!$user) {
        echo($user['id']);
    } else {
        $sql = $pdo->prepare("INSERT INTO users(username, password) VALUES (?, ?)");
        $sql->execute(array($username, $password));
        $user = $sql->fetch();

        $sql = $pdo->prepare("SELECT * FROM users WHERE username = (?)");
        $sql->execute(array($username));
        $user = $sql->fetch();
        echo($user['id']);
    }
?>