function conformation(ev,id){

    ev.preventDefault();
    var urlRedirect = ev.currentTarget.getAttribute('action');
    console.log(urlRedirect);
    swal({
        title :"Are you sure to deny",
        text  :"This Request is rejected after your confirmation",
        icon  :"warning",
        buttons: true,
        dangerMode: true
    })

    .then((willCancel)=>
    {
        if(willCancel){
            document.getElementById("myForm"+ id +"").submit();
        }
    });

}