function getDepartment()
{
    $(document).delegate("[data-bs-target='#editDepartmentModal']", "click", function() {
        const department_id = $(this).attr('data-id');
        console.log(department_id);
        // Ajax config
        $.ajax({
            type: "POST", //we are using GET method to get data from server side
            url: 'http://localhost/proyectoFinal/detail_department', // get the route value
            data: {department_id}, //set data
            beforeSend: function () {//We add this before send to disable the button once we submit it so that we prevent the multiple click
            },
            success: function (response) {
                const department = JSON.parse(response)
                $("#edit-form [name=\"id\"]").val(department.idDepartment);
                $("#edit-form [name=\"name\"]").val(department.name);
                $("#edit-form [name=\"description\"]").val(department.description);
                $("#edit-form [name=\"phone\"]").val(department.phone);
                $("#edit-form [name=\"emailDepartment\"]").val(department.emailDepartment);
                $("#edit-form [name=\"iconDepartment\"]").val(department.iconDepartment);
                $("#edit-form [name=\"disable\"]").val(department.disable);
            }
        });
    });
}

function update()
{
    $("#btnUpdateSubmit").on("click", function() {
        const $this = $(this); //submit button selector using ID
        const $caption = $this.html();// We store the html content of the submit button
        const form = "#edit-form"; //defined the #form ID
        const formData = $(form).serializeArray(); //serialize the form into array
        const route = $(form).attr('action'); //get the route using attribute action

        // Ajax config
        $.ajax({
            type: "POST", //we are using POST method to submit the data to the server side
            url: route, // get the route value
            data: formData, // our serialized array data for server side
            beforeSend: function () {//We add this before send to disable the button once we submit it so that we prevent the multiple click
            },
            success: function (response) {//once the request successfully process to the server side it will return result here
                window.location.reload();
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                // You can put something here if there is an error from submitted request
            }
        });
    });
}

function deleteDepartment(id)
{
        $.ajax({
            type: "POST", //we are using POST method to submit the data to the server side
            url: "http://localhost/proyectoFinal/delete_department", // get the route value
            data: {id}, // our serialized array data for server side
            beforeSend: function () {//We add this before send to disable the button once we submit it so that we prevent the multiple click
            },
            success: function (response) {//once the request successfully process to the server side it will return result here
                window.location.reload();
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) {
                // You can put something here if there is an error from submitted request
            }
        });
}

$(document).ready(function() {
    getDepartment();
    update();
});