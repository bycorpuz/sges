$(document).ready(function() {
    $('label').click(function() {
        position_id = this.id.split('_')[1];
        candidate_id = this.id.split('_')[2] != '' ? this.id.split('_')[2] : '';

        id = position_id + '_' + candidate_id;

        $('label[id^="c_' + position_id + '_"]').removeClass('selected');
        $('img[id^="p_' + position_id + '_"]').removeClass('selected');

        $('#c_' + id).addClass('selected');
        $('#p_' + id).addClass('selected');

        candidate_name = $('#r_' + id).val() != '' ? $('#r_' + id).val() : 'Abstain';

        $('#' + position_id + '_cname').html('');
        $('#' + position_id + '_cname').append(candidate_name);
        $('#' + position_id + '_value').html('');
        $('#' + position_id + '_value').val(candidate_id);
    });
});

function openPosition(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
      tabcontent[i].style.display = "none"; 
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
      tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

function openCastVote() {
    $.ajax({
        type: 'get',
        url: '/comelec/position/list',
        success: function(data) {
            valid = true;
            $.each(data, function(key, value) {
                // position_value = $('#' + value.id + '_value').val();
                position_value = $('#' + value.id + '_cname').html();
                if(position_value == "") {
                    valid = false;
                }
            });
            if(valid) {
                $('#message').html('');
                openModal();
            }
            else {
                $('#message').html('Please vote in all positions');
            }
        },
    });
}

function openModal() {
    document.getElementById('vote_summary').style.display='block';
}

function closeModal() {
    document.getElementById('vote_summary').style.display='none';
}