$(document).ready(function() {
    // Department select box
    var departmentSelect = $("#department");
    // Designation select box
    var designationSelect = $("#designation");
    
    
    departmentSelect.on("change", function() {
       
        var departmentId = departmentSelect.val();  
        designationSelect.html("<option value=''>Select Designation</option>");
        
        if (departmentId) {
          //  alert(departmentId);
         
            $.ajax({
                url: "./php/load_designations.php",
                type: "GET",
                data: { department_id: departmentId },
                success: function(response) {
                  
                    designationSelect.append(response);
                  
                    designationSelect.prop("disabled", false);
                },
            });
        } else{
           
            designationSelect.prop("disabled", true);
        }
    });
});