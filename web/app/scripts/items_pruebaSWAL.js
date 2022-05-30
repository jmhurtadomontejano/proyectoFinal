    $("#btnUpdateSubmit").click(function(){
    let id = $("#id").val();
    Swal.fire({
      title: "Atención",
      text: "¿Deseas editar el item " + id + " ?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si",
      cancelButtonText: "No",
    }).then((result) => {
        if (result.value) {
            let url_post = $("#url").val();
            let id = $("#id").val();
            let name = $("#name").val();
            let description = $("#description").val();
            let location = $("#location").val();
            let id_department = $("#id_department").val();
            let id_service = $("#id_service").val();
            let id_attendUser = $("#id_attendUser").val();
            let id_clientUser = $("#id_clientUser").val();
            let date = $("#date").val();
            let duration = $("#duration").val();
            let states = $("#state").val();
            let result = $("#result").val();
            const datos = {
                id,
                name,
                description,
                location,
                id_department,
                id_service,
                id_attendUser,
                id_clientUser,
                date,
                duration,
                state,
                result
            }
             // Ajax config
             $.ajax({
                type:'POST',
                data:datos,
                url:url_post,
                success:function(response){
                    console.log(response);
                    if (response == 'true'){
                        Swal.fire({
                            position:'center',
                            icon:'success',
                            title:'El item ha sido actualizado',
                            showConfirmButton: false,
                            timer:1000
                        });
                    }else{
                     Swal.fire({
                         position:'center',
                         icon:'info',
                         title:'El item NO ha sido actualizado',
                         showConfirmButton: false,
                         timer:1000
                     });
                    }
                }
              });
      window.location.reload();
        }else{}
  });
});


function filterByColumn() {
  let filter = { date: null, depart: null };

  $("#inputDate").change(function () {
    const date = new Date($("#inputDate").val());
    filter.date = `${date.getFullYear()}-${date.getMonth() + 1}-${
      date.getDate() + 1
    }`;
    handleFilter(filter);
  });

  $("#inputDepartment").change(function () {
    const depart = $("#inputDepartment").val();
    filter.depart = depart;
    handleFilter(filter);
  });
}

function handleFilter(filter) {
  $("#formFilter").submit();
}

$(document).ready(function () {
  filterByColumn();
});
