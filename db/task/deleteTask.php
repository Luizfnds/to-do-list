<?php
    include '../dbConfig.php';
    
    $id = $_GET['id'];

    $sql = $pdo->prepare("DELETE FROM tasks WHERE id=(?)");
    $sql->execute(array($id));
?>