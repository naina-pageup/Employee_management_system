$('#department').change(function() {
    var departmentId = $(this).val();
    $.ajax({
        url: './load_designation/'+ departmentId,
        type: 'GET',
        success: function(data) {
            $('#designation').empty();
            $.each(data, function(index, designations) {
                $('#designation').append('<option value="'+designations.id+'">'+designations.name+'</option>');
            });
        }
    });
});
