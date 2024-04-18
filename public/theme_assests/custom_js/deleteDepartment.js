function conformation(ev,id){

    ev.preventDefault();
    var urlRedirect = ev.currentTarget.getAttribute('action');
    console.log(urlRedirect);
    swal({
        title :"Are you sure to delete",
        text  :"you won't be able to revert this delete",
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