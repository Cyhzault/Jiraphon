/**
 * Created by Cyhzault on 22/04/2016.
 */

var listOfKanban;
var activeKanban;
var dropDown;
var taskInfo = document.getElementById('taskInfo');
var taskFormulary = document.getElementById('taskFormulary');
var selectedUserFormulary = "-- select --";

window.onload = initialized;
window.onclick = function (event) {
    if(event.target == taskInfo)
    {
         $(taskInfo).hide();
    }

    if(event.target == taskFormulary)
    {
        $(taskFormulary).hide();
        $("#formularyError").hide();
    }
};

function manageChange(taskId,oldStatut,newStatut)
{
    var json = '{"taskId":'+taskId+',"OldS":"'+oldStatut+'","NewS":"'+newStatut+'"}';
    json = JSON.stringify(JSON.parse(json));
    $.ajax({
        url: './api.php?requestType=taskUpdate',
        type: 'POST',
        data: {"json":json},
        datatype:"text",
        success:function(data) { console.log(data);},
        error: function(data) {console.log(data);}
    });
}

function updateActiveKanban(teamMember)
{
    var name = teamMember.split("_");

    $(activeKanban).hide();
    $(activeKanban).removeClass("active");
    $(dropDown).html(name[0]+" <span class='caret'></span>");
    $("#"+name[0]+"_kbn").addClass("active");

    activeKanban = $('.active');
    $(activeKanban).show();
}

function updateTaskData(data)
{
    task = JSON.parse(data);
    $('#task-name').html(task['nom']);
    $('#task-desc').html(task['desc']);
    $('#task-deb').val(task['date_deb']);
    $('#task-fin').val(task['date_fin']);
}

function updateTaskFormulary(data)
{

    task = JSON.parse(data);
    console.log(task);
    $('#taskFormulary-id').html(task['id_tache']);
    $('#taskFormulary-name').html(task['nom']);
    $('#taskFormulary-desc').html(task['desc']);
}

function showTaskData(idTask)
{
    $.ajax({
        url: './api.php?requestType=taskInfo',
        type: 'POST',
        data: {"json":idTask},
        datatype:"text",
        success:function(data) { updateTaskData(data)},
        error: function(data) {console.log(data) }
    });


    $(taskInfo).show();
}

function showTaskFormulary(idTask) {
    $.ajax({
        url: './api.php?requestType=taskInfo',
        type: 'POST',
        data: {"json":idTask},
        datatype:"text",
        success:function(data) { updateTaskFormulary(data)},
        error: function(data) {console.log(data) }
    });


    $(taskFormulary).show();
}

function updateFormulary(userName)
{
    var name = userName.split("_")
    selectedUserFormulary = name[0];
    $("#assignmentDropdown").html(name[0]+"<span class='caret'></span>");
}

function handleSubmit()
{
    var taskId = $("#taskFormulary-id").html();
    if(selectedUserFormulary == "-- select --")
        displayFormularyError("Il faut attribuer la tâche à quelqu'un.");
    else{
        var json = '{"taskId":"'+taskId+'","pseudo":"'+selectedUserFormulary+'"}';
        console.log(json);
        json = JSON.stringify(JSON.parse(json));

        $.ajax({
            url: './api.php?requestType=taskAttribution',
            type: 'POST',
            data: {"json":json},
            datatype:"text",
            success:function(data) { console.log(data)
                $(taskFormulary).hide();
                            $("#formularyError").hide();},
            error: function(data) {displayFormularyError(data)}
        });
    }


}

function displayFormularyError(errorMsg)
{
    $("#formularyError").html(errorMsg);
    $("#formularyError").show();
}

function handleDelete()
{

}
function initialized()
{
    // permet de bouger des images
    $('.editable').draggable(
        {
            helper: 'clone',

            // fait revenir la tache à son point de départ avec une animation si celle-ci n'est pas lâchée au bon endroit.
            revert:'invalid'
        });

    $('.taskList').droppable(
        {
            accept:'.task',

            drop : function(event, ui)
            {
                var oldParent = ui.draggable[0].parentElement;
                ui.draggable.detach().appendTo($(this));
                if(event.target.id != oldParent.id)
                {
                    manageChange(ui.draggable[0].id,oldParent.id,this.id);
                }
            }
        });

    listOfKanban = $('.kanban');
    activeKanban = $('.active');
    dropDown = $('#teamDropdown');

    if(listOfKanban != null && activeKanban != null)
    {
        listOfKanban.hide();
        activeKanban.show();
    }
    $('.taskToManage').hide();

    $(".teamMember").click(function ()
    {
        updateActiveKanban(this.id);
        $(".taskToManage").hide();
    });

    $(".formulary-teamMember").click(function ()
    {
        updateFormulary(this.id);
    });

    $(".task").click(function(){
        showTaskData(this.id);
    });

    $(".manageableTask").click(function() {
        showTaskFormulary(this.id);
    });

    $(".closeBtn").click(function(){
        $(taskInfo).hide();
        $(taskFormulary).hide();
        $("#formularyError").hide();

    });

    $("#taskToManageBtn").click(function(){
        $(".active").hide();
        $(".taskToManage").show();
    })

    $("#submitBtn").click(function(){
        handleSubmit();
    });

    $("#deleteBtn").click(function(){
        $("#formularyError").hide();
        handleDelete();
    });

}




