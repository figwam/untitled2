
checkField('firstName');
checkField('surname');
checkField('secondName');
checkField('phone');
checkField('email');
checkField('firstPass','secondPass');


$("#button").on("click", function(){
    var obj = {
        firstName:$("#firstName").val(),
        surname:$("#surname").val(),
        secondName:$("#secondName").val(),
        phone:$("#phone").val(),
        email:$("#email").val(),
        firstPass:$("#firstPass").val(),
        secondPass:$("#secondPass").val()
    };
    $.ajax({
        url:"../../core/Users.php",
        type:"GET",
        data:({object:obj}),
        dataType:'json',
        beforeSend:function(){
            $(".but").before("<p id='notification'>Ожидайте...</p>")
        },
        success:function(result)
        {
            //firstName, .status .surname, .status .secondName, .status .phone, .status .email, .status .firstPass, .status .secondPass
            $(".status .st").removeClass('before defeat success');
            $("#notification").remove();
            if(result)
            {
                for(key in result)
                {
                    if(key == 'password' || key == 'firstPass' || key == 'secondPass')
                    {
                        $(".firstPass, .secondPass").addClass("defeat");
                        continue;
                    }
                    $(".status ." + key).addClass("defeat");
                }
            }
            else
            {
                $(location).attr('href', "../../index.php");
                //alert('Регистрация прошла успешно');
            }

        }
    });
});