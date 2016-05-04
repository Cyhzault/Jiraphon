/**
 * Created by Cyhzault on 22/04/2016.
 */

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
                console.log($(ui.draggable).html());
                console.log($(this).html());
            }
                    }
    });

    var listOfKanban = $('.kanban');
    var activeKanban = $('.active');
        listOfKanban.hide();
        activeKanban.show();
    if(listOfKanban != null)
        for(var i = 0; i<listOfKanban.length;i++)
        {
            $
        }
