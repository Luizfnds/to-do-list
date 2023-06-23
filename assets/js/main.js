function getCookieValue(cookieName) {    
    const cDecoded = decodeURIComponent(document.cookie);
    const cArray = cDecoded.split("; ");
    let cookieValue = "";
    cArray.forEach(cookie => {
      if(cookie.indexOf(cookieName) == 0) {
        cookieValue = cookie.substring(cookieName.length + 1);
      }
    })
    return cookieValue;
}

function getTasks() {
    $.ajax({
        url: "db/task/selectTasks.php",
        type: "get",
        data: {
        }
    }).done(function(e) {
        $("#task_list").html(e);
    })
}

function atualizaPagina() {
    if(getCookieValue('user_id')) {
        var id = getCookieValue('user_id');
        $.ajax({
            url: "db/user/getUserData.php",
            type: "get",
            data: {
                id: id
            }
        }).done(function(e) {
            $("#login_container").html(
                `<p>Bem vindo ${e}!</p>
                <div id=btn_logout>DESCONECTAR-SE</div>`);
        })
    } else {
        $("#login_container").html(
                "<form action=post>"+
                    "<input id=username name=username type=text placeholder=username>"+
                    "<input id=password name=username type=password placeholder=password>"+
                    "<div id=btn_logar>CONECTAR-SE<i class=fa-solid fa-right-to-bracket></i></div>"+
                "</form>");
    }
    getTasks();
}

window.onload = function() {
    atualizaPagina();
};

$(document).on('click', '#btn_logar', function() {
    var username = $("#username").val();
    var password = $("#password").val();

    if(username.length < 4) {
        alert("nome de usuario deve ter ao menos 4 digitos");
    } else if(password.length < 4) {
        alert("senha deve ter ao menos 4 digitos");
    } else {
        $.ajax({
            url: "db/user/connectUser.php",
            type: "post",
            data: {
                username: username,
                password: password
            }
        }).done(function(e) {
            document.cookie = `user_id=${e}`;
            atualizaPagina();
        })
    }
})

$(document).on('click', '#btn_logout', function() {
    document.cookie = 'user_id=';
    atualizaPagina();
})

$(document).on('click', '#btn_create', function() {
    if(!getCookieValue('user_id')) {
        alert("Não logado!");
    } else {
        var taskDescription = $("#task_description_create_input").val();
        var priority = $("#priority_input").val();

        if(taskDescription.length < 1) {
            alert("Insira uma descrição na tarefa");
        } else {
            $.ajax({
                url: "db/task/createTask.php",
                type: "post",
                data: {
                    taskDescription: taskDescription,
                    priority: priority
                }
            }).done(function(e) {
                getTasks();
            })
        }
    }
})

$(document).on('click', '.btn_delete', function() {
    var id = $(this).parent().attr("id");
    $.ajax({
        url: "db/task/deleteTask.php",
        type: "get",
        data: {
            id: id
        }
    }).done(function(e) {
        getTasks();
    })
})

$(document).on('click', '.task_is_complete', function() {
    var isComplete = $(this).prop('checked') ? 1 : 0;
    var id = $(this).parent().attr("id");

    $.ajax({
        url: "db/task/updateTask.php",
        type: "post",
        data: {
            id: id,
            isComplete: isComplete
        }
    }).done(function(e) {
        getTasks();
    })
})

$(document).on('click', '.btn_update', function() {
    var parentElement = $(this).parent();
    parentElement.find('[class="task_description"]').prop("disabled", false).addClass('task_description_update_input');
    $(this).hide();
    parentElement.find('[class="btn_save"]').show();
})

$(document).on('click', '.btn_save', function() {
    var parentElement = $(this).parent();
    var id = $(this).parent().attr("id");
    var taskDescriptionElement = parentElement.find('[class="task_description task_description_update_input"]');
    var taskDescription = taskDescriptionElement.val();

    $.ajax({
        url: "db/task/updateTask.php",
        type: "post",
        data: {
            id: id,
            taskDescription: taskDescription,
        }
    }).done(function(e) {
        getTasks();
    })

    taskDescriptionElement.prop("disabled", true).removeClass('task_description_update_input');
    $(this).hide();
    parentElement.find('[class="btn_update"]').show();
})
