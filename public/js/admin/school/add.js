$(document).ready(function() {
    $('#region').change(function() {
        region_id = $(this).val();

        $.ajax({
            type: 'get',
            url: '/searchDivisionByRegion',
            data: {
                id: region_id,
            },
            success: function(data) {
                // options = "";
                // alert(data);
                // $.each(data, function(data) {
                //     options += "<option value='" + data.id + "'>" + data.division_name + "</option>";
                // });

                $("#division").html('');
                $("#division").append(data);
            }
        });
    });
});