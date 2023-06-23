<?php
    include '../dbConfig.php';
        
    if(isset($_COOKIE['user_id'])) {
        $userId = $_COOKIE['user_id'];

        $sql = $pdo->prepare("SELECT * FROM tasks WHERE user_id = (?) ORDER BY is_complete DESC, FIELD(priority, 'High', 'Medium', 'Low')");
        $sql->execute(array($userId));
        $allTasks = $sql->fetchAll();
        if(count($allTasks) == 0) {
            echo(
            "<div id=not_logged_in>
                <i class='fa-solid fa-list-check'></i>
                Nenhuma tarefa por aqui
            </div>"
            );
        } else {
            foreach($allTasks as $task) {
                $isChecked = $task["is_complete"] ? "checked" : "";
                echo(
                "<div id=$task[id] class=task>
                    <input type=checkbox class=task_is_complete $isChecked>
                    <input type=text class=task_description disabled value='$task[task_description]'>
                    <spam class=task_priority>$task[priority]</spam>
                    <div class=btn_save><i class='fa-solid fa-floppy-disk'></i></div>
                    <div class=btn_update><i class='fa-solid fa-pen'></i></div>
                    <div class=btn_delete><i class='fa-solid fa-trash'></i></div>
                </div>"
                );
            }
        } 
    } else {
        echo("
        <div id=not_logged_in>
            <i class='fa-solid fa-user'></i>
            <p>Conecte-se para poder criar tarefas</p>
        </div>
        ");
    }

?>