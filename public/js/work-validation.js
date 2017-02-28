$(document).ready(function(){
    $( "#addWork" ).submit(function( event ) {
        event.preventDefault();
        var url = 'secret/addWork';
        var data = new FormData(document.getElementById('addWork'));
        var files;
        $('input[type=file]').change(function(){
            files = this.files;
        });
        $.each( files, function( key, value ){
            data.append( key, value );
        });
        $.ajax({
            type: 'post',
            url: url,
            data: data,
            processData: false,
            contentType: false,
            success: function (data) {
                console.log(data);
                $(".label-danger").css("display", "none");
                $(".label-success").css("display", "block");
            },
            error: function (data) {
                console.log(data);
                var errors = data.responseJSON;
                $(".label-success").css("display", "none");
                $(".label-danger").css("display", "block");
                $(".label-danger").text(errors[Object.keys(errors)[0]]);
            }
        })
    });

    $(".close").on("click", function (event) {
        $(".label-danger").css("display", "none");
        $(".label-success").css("display", "none");
    })
});