$(document).ready(function () {
    $('#markRead, #markUnread').on('click', function () {
        if($('.msgMarker:checked').length <= 0){
            alert("You must select a checkbox to continue");
            return false;
        }
        
        showLoader();
        var ids = '';
        
        $('.msgMarker:checked').each(function () {
            ids += $(this).val() + ",";
        });
        var task = $(this).prop('id');
        $.ajax({
            url: $('#ajaxUrl').val(),
            data: {ids: ids, task: task},
            type: 'post',
            dataType: 'json',
            success: function (data) {
                alert(data.msg);
                hideLoader();
                location.reload();
                
            }
        });
    });

    $('#moveInbox, #moveTrash').on('click', function () {
        if($('.msgMarker:checked').length <= 0){
            alert("You must select a checkbox to continue");
            return false;
        }
         showLoader();
        var ids = '';

        $('.msgMarker:checked').each(function () {
            ids += $(this).val() + ",";
        });
        var task = $(this).prop('id');
        var move = $(this).prop('id') == 'moveInbox' ? 'inbox' : 'trash';
        if (confirm("Are you sure want to move selected item to "+move+" ?")) {

            $.ajax({
                url: $('#ajaxUrlMove').val(),
                data: {ids: ids, task: task},
                type: 'post',
                dataType: 'json',
                success: function (data) {
                    alert(data.msg);
                    hideLoader();
                    location.reload();
                }
            });
        }
    });
    
    $('#search').on('click',function(){
        $('#message-form').submit();
    })
});
