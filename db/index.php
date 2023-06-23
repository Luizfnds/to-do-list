<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="cache-control" content="no-cache" />
    <link rel="stylesheet" href="assets/css/style.css"></link>
    <title>Code challenge XNEO</title>
</head>
<body>
    <div id="login_container">
    </div>
    <div id="container">
        <div id="title">TO-DO LIST</div>
        <form id="create_task" action="post">
            <input type="text" id="task_description_create_input" name="task_description_create_input" placeholder="Descrição">
            <select id="priority_input" name="priority">
                <option value="High">High</option>
                <option value="Medium">Medium</option>
                <option value="Low">Low</option>
            </select>
            <div id="btn_create" value="btn_create">ADICIONAR<i class="fa-solid fa-plus"></i></div>
        </form>
        <div id="task_list"></div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://kit.fontawesome.com/06875db8d3.js" crossorigin="anonymous"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>