function open_modal(modal, party_id = null) {
    if(party_id) {
        $.ajax({
            type: 'get',
            url: '/comelec/party/info',
            data: {
                party_id: party_id,
            },
            success: function(data) {
                $('#id').val(data.id);
                $('#party_name').val(data.party_name);
                $('#description').val(data.description);
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