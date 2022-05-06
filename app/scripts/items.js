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