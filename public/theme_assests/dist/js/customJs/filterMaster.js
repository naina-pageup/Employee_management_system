$("#search_with_all_filter").on("submit",function(e){
   
    var managerId = getManagerSelectValue();
    var salaryFilter = salaryFilterSelect();
    var rank_get =  $("#sal_filter_rank").val();
    var  startDate = $("#start_date").val(); 
    var  endDate= $("#end_date").val(); 
    var  minValue = $("#min_sal").val(); 
    var  maxValue= $("#max_sal").val(); 

    var obj = { managerId: managerId,min_value:minValue,max_value:maxValue,start_date:startDate,end_date:endDate,sal_filter:salaryFilter,rank:rank_get};
    var myJson = JSON.stringify(obj);

    $.ajax({
        url: "./php/filterDataMaster.php",
        type: "POST",
        data: myJson,
        dataType : "json",
        success: function(data) {
            $('#search_with_all_filter').trigger("reset");
            $("#sal_filter_rank").prop('disabled', true);
                var html ='';
                console.log(data);
                $.each(data,function(key,value){
                html = html +("<tr>"+
                                    
                                    "<td>" + value.employee_id +"</td>"+ 
                                    "<td>" + value.name +"</td>"+ 
                                    "<td>" + value.contact +"</td>"+ 
                                    "<td>" + value.salary +"</td>"+ 
                                    "<td>" + value.joining_date +"</td>"+ 
                                    "<td>" + value.manager_name +"</td>"+ 
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
    e.preventDefault();
});

function getManagerSelectValue(){

    var managerSelect = $("#manager");
    var managerId = managerSelect.val(); 
    
    return managerId

}

function salaryFilterSelect(){

   
    var  salSelect = $("#Filter_salary");
    var  salaryFilterGetValue = salSelect.val(); 
    if(salaryFilterGetValue)
    {
    $("#sal_filter_rank").prop('disabled', false);
    }else{
    $("#sal_filter_rank").prop('disabled', true);

    }
    return salaryFilterGetValue
}

// function lowestsalaryFilterSelect(){
//     var  SalarylowSelect = $("#Filter_salary_lowest");
//     var  lowSalSelectValue = SalarylowSelect.val(); 
   
//     return lowSalSelectValue
// }
$(document).ready(function() {
    var managerId = "";
    var  startDate = ""; 
    var  endDate= ""; 
    var  minValue =""; 
    var  maxValue= ""; 
    var  salaryFilter ="";
    var  rank_get  = "";
    var obj = { managerId: managerId,min_value:minValue,max_value:maxValue,start_date:startDate,end_date:endDate,sal_filter:salaryFilter,rank:rank_get};
    var myJson = JSON.stringify(obj);
    $.ajax({
        url: "./php/filterDataMaster.php",
        type: "POST",
        data: myJson,
        dataType : "json",
        success: function(data) {
            $('#search_with_all_filter').trigger("reset");
                var html ='';
                console.log(data);
                $.each(data,function(key,value){
                html = html +("<tr>"+
                                    
                                    "<td>" + value.employee_id +"</td>"+ 
                                    "<td>" + value.name +"</td>"+ 
                                    "<td>" + value.contact +"</td>"+ 
                                    "<td>" + value.salary +"</td>"+ 
                                    "<td>" + value.joining_date +"</td>"+ 
                                    "<td>" + value.manager_name +"</td>"+ 
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
})