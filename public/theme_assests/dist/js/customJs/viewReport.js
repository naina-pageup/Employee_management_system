$(document).ready(function() {
    // Manager select box
    var managerSelect = $("#manager");
    var  minValue =""; 
    var  maxValue= ""; 
    var  startDate = ""; 
    var  endDate = ""; 
    var highSalSelectValue = "";
    var  lowSalSelectValue = "";
      managerSelect.on("change", function() {
        //$('#search-salary-Table').hide();
        var managerId = managerSelect.val(); 
        //alert(typeof(managerId)) ;  
        var obj = { managerId: managerId,min_value:minValue,max_value:maxValue,start_date:startDate,endDate:endDate,high_Sal_value:highSalSelectValue,low_sal_value:lowSalSelectValue};
        var myJson = JSON.stringify(obj);
        if (managerId) {
          //  alert(departmentId);
            $.ajax({
                url: "./php/filterData.php",
                type: "POST",
                data: myJson,
                dataType : "json",
                success: function(data) {
                    // $("#search-Manager-Table").css("display", "block");
                    // $("#search-salary-Table").css("display", "none");
         
                        var html ='';
                        console.log(data);
                        $.each(data,function(key,value){
                        html = html +("<tr>"+
                                            
                                            "<td>" + value.employee_id +"</td>"+ 
                                            "<td>" + value.name +"</td>"+ 
                                            "<td>" + value.contact +"</td>"+ 
                                            "<td>" + value.salary +"</td>"+ 
                                            "<td>" + value.joining_date +"</td>"+ 
                                            "<td><a href='./viewEmp.php?e_id="+value.id+"'><i class='fas fa-eye'></i></a>&nbsp; &nbsp; <a href='./editEmp.php?e_id="+value.id+"'><i class='fas fa-edit'></i></a> &nbsp; &nbsp;<a href='./removeEmp.php?e_id="+value.id+"'  ><i class='fa fa-trash' aria-hidden='true' style='color:red;'></i></a></td>"+
                                            "</tr>");
                        });
                        $("#load-table").html(html); 
                        if(data == 0){
                            html = html +("<tr>"+
                            "<td colspan='6'> No Result Found </td>"+ 
                            "</tr>");
                            $("#load-table").html(html); 
                        }
                },
            });
        } else{
           
            managerSelect.prop("disabled", true);
        }
    });
});
