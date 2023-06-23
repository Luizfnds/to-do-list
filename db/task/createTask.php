<?php
    include '../dbConfig.php';

    $taskDescription = $_POST['taskDescription'];
    $priority = $_POST['priority'];
    $userId = $_COOKIE['user_id'];

    $sql = $pdo->prepare("INSERT INTO tasks(task_description, priority, user_id) VALUES (?, ?, ?)");
    $sql->execute(array($taskDescription, $priority, $userId));
?>