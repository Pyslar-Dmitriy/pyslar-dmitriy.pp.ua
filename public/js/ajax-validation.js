$(document).ready(function(){
    $( "#regForm" ).submit(function( event ) {
        event.preventDefault();
        var $form = $( this ),
            data = $form.serialize(),
            url = "register";
        
        $.ajax({
            type: 'post',
            url: url,
            data: data,
            success: function (data) {
                $(".label-danger").css("display", "none");
                $(".label-success").css("display", "block");
            },
            error: function (data) {
                var errors = data.responseJSON;
                console.log(data);
                $(".label-danger").css("display", "block");
                $(".label-danger").text(errors[Object.keys(errors)[0]]);
            }
        })
    });

    $( "#loginForm" ).submit(function( event ) {
        event.preventDefault();
        var $form = $( this ),
            data = $form.serialize(),
            url = "login";

        $.ajax({
            type: 'post',
            url: url,
            data: data,
            success: function (data) {
                console.log(data);
                $(".label-danger").css("display", "none");
                window.location.reload(true);
            },
            error: function (data) {
                console.log(data);
                $(".label-danger").css("display", "block");
                $(".label-danger").text(data.responseJSON);
            }
        })
    });


    $( "#sendMail" ).submit(function( event ) {
        event.preventDefault();
        var $form = $(this),
            data = $form.serialize(),
            url = 'sendMail';
        $.ajax({
            type: 'post',
            url: url,
            data: data,
            success: function (data) {
                $("#sendFailed").css("display", "none");
                $("#sendSuccess").css("display", "block");
                return false;
            },
            error: function (data) {
                var errors = data.responseJSON;
                $("#sendSuccess").css("display", "none");
                $("#sendFailed").css("display", "block");
                $("#sendFailed").text(errors[Object.keys(errors)[0]]);
                return false;
            }
        });
    });

        




    $(".close").on("click", function (event) {
        $(".label-danger").css("display", "none");
        $(".label-success").css("display", "none");
    })
});
