<?php
    include '../dbConfig.php';
    
    $id = $_POST['id'];

    if(isset($_POST['taskDescription'])) {
        $taskDescription = $_POST['taskDescription'];
        $sql = $pdo->prepare("UPDATE tasks SET task_description = (?) WHERE id=(?)");
        $sql->execute(array($taskDescription, $id));
    }

    if(isset($_POST['isComplete'])) {
        $isComplete = $_POST['isComplete'];
        $sql = $pdo->prepare("UPDATE tasks SET is_complete = (?) WHERE id=(?)");
        $sql->execute(array($isComplete, $id));
    }
?>