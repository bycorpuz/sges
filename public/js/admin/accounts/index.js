function open_modal(modal, user_id = null) {
    if(user_id) {
        $.ajax({
            type: 'get',
            url: '/admin/user/info',
            data: {
                user_id: user_id,
            },
            success: function(data) {
                $('#id').val(data['user'].id);
                $('#username').val(data['user'].username);
                $('#last_name').val(data['profile'].last_name);
                $('#first_name').val(data['profile'].first_name);
                $('#middle_name').val(data['profile'].middle_name); 
                document.getElementById(modal).style.display='block';
            },
        });
    }
    else {
        document.getElementById(modal).style.display='block';
    }
}

function close_modal(modal) {
    document.getElementById(modal).style.display='none';
}