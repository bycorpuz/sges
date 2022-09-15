function open_modal(modal, voter_id = null) {
    if(voter_id) {
        $.ajax({
            type: 'get',
            url: '/comelec/voter/info',
            data: {
                voter_id: voter_id,
            },
            success: function(data) {
                $('#id').val(data['profile'].id);
                $('#lrn').val(data['profile'].lrn);
                $('#last_name').val(data['profile'].last_name);
                $('#first_name').val(data['profile'].first_name);
                $('#middle_name').val(data['profile'].middle_name);
                $('#section').val(data['profile'].section);
                
                $('#grade').html('');
                $('#grade').html(data['grade']);

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