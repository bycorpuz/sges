$(document).ready(function() {
    $('#add_modal_grade').hide();
    // $('#edit_modal_grade').hide();

    $('#add_modal_position').change(function() {
        if($(this).val() == 8 || $(this).val() == 9) {
            $('#add_modal_grade').show();
            $('#add_modal_select_grade').prop('required', true);
        }
        else {
            $('#add_modal_grade').hide();
            $('#add_modal_select_grade').prop('required', false);
        }
    });

    $('#edit_modal_position').change(function() {
        if($(this).val() == 8 || $(this).val() == 9) {
            $('#edit_modal_grade').show();
            $('#edit_modal_select_grade').prop('required', true);
        }
        else {
            $('#edit_modal_grade').hide();
            $('#edit_modal_select_grade').prop('required', false);
        }
    });
});

function open_modal(modal, candidate_id = null) {
    if(candidate_id) {
        $.ajax({
            type: 'get',
            url: '/comelec/candidate/info',
            data: {
                candidate_id: candidate_id,
            },
            success: function(data) {
                $('#id').val(data['candidate'].id);
                $('#edit_modal_last_name').val(data['candidate'].last_name);
                $('#edit_modal_first_name').val(data['candidate'].first_name);
                $('#edit_modal_middle_name').val(data['candidate'].middle_name);

                $('#edit_modal_party').html('');
                $('#edit_modal_party').html(data['party_list']);

                $('#edit_modal_position').html('');
                $('#edit_modal_position').html(data['position']);

                $('#edit_modal_select_grade').html('');
                $('#edit_modal_select_grade').html(data['grade']);

                if(!data['view_grade']) {
                    $('#edit_modal_grade').hide();
                    $('#edit_modal_select_grade').prop('required', false);
                }
                else {
                    $('#edit_modal_grade').show();
                    $('#edit_modal_select_grade').prop('required', true);
                }

                $('#photo').html(data['photo']);

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
