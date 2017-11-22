$("#button").on("click", function(){
    var obj = {
        phoneEmail:$("#phoneEmail").val(),
        password:$("#password").val()
    };
    $.ajax({
        url:"../../core/Users.php",
        type:"GET",
        data:({autho:obj}),
        dataType:'json',
        beforeSend:function(){
            $(".status .phoneEmail, .status .password").addClass("before");
            $(".but").before("<p id='notification'>Ожидайте...</p>")
        },
        success:function(result)
        {
            $(".status .st").removeClass('before defeat success');
            $("#notification").remove();
            if(!result)
                $(".status .phoneEmail, .status .password").addClass("defeat");
            else
            {
                $(".status .phoneEmail, .status .password").addClass("success");
                $(location).attr('href', "../../index.php");
            }
            $(".status .phoneEmail, .status .password").on('focus', function(){
                $(".status .st").removeClass('before defeat success');
            });
        }
    });
});