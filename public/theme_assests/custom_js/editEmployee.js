$('#department').change(function() {
    var departmentId = $(this).val();
    $.ajax({
        url: '../getdesignation/'+ departmentId,
        type: 'GET',
        success: function(data) {
            $('#designation').empty();
            $.each(data, function(index, designations) {
                $('#designation').append('<option value="'+designations.id+'">'+designations.name+'</option>');
            });
        }
    });
});