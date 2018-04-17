function deleteTask(el){
    //$('#list-tasks-block .delete-task').on('click', function () {
        var host = 'http://' + location.host + '/';
        var url = host + 'task/delete_task';
        var data = $(el).attr('val');
        if (confirm('Delete?')) {
            $.ajax({
                type: "POST",
                dataType: 'html',
                data: {id: data},
                url: url, 
                
                success: function(result){
                    $('#list-tasks-block').html(result);
                }
            });
        } 
        return 0;
    //});
}


