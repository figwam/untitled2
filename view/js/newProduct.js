$("#slider").on("input", function(){
    $("#numb").val($("#slider").val());
});
$("#numb").on("input", function(){
    $("#slider").val($("#numb").val());
});
$("#button").on("click",function () {
    $(".error, .success, .before").remove();
    var bool = $("#slider").val() && $("#name").val() && $("#prices").val() && $("#image").val();
    if(bool)
    {
        var $that = $("#form"),
            formData = new FormData($that.get(0));
        $.ajax({
            url:"../../core/Product.php",
            type:"POST",
            data:formData,
            dataType:"json",
            contentType: false,
            processData: false,
            beforeSend:function () {
                $("#button").before("<p class = 'before'>Ожидайте...</p>");
            },
            success:function(data){
                $(".before").remove();
                if(data === true)
                {
                    $("#button").before("<p class = 'success'>Товар успешно зарегистрирован!</p>");
                }
                else
                    $("#button").before("<p class = 'error'>Ошибка! Проверьте, заполнены ли все поля!</p>");
            }
        });
    }
    else
    {
        $("#button").before("<p class = 'error'>Не все поля заполнены!</p>");
    }
});
//Редактирование
$("#edit").on("click", function () {
    $(".error, .success, .before").remove();

    var $that = $("#form"),
        formData = new FormData($("#form").get(0));
    formData.append('edit', true);
    $.ajax({
        url:"../../core/Product.php",
        type:"POST",
        data:formData,
        dataType:"json",
        contentType: false,
        processData: false,
        beforeSend:function () {
            $("#edit").before("<p class = 'before'>Ожидайте...</p>");
        },
        success:function(){
            $(location).attr('href', 'userPage.php');
        }
    });
});
$("#room").on("click", function () {
    $(location).attr('href', "userPage.php");
});
