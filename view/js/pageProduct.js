/**
 * Created by figwam on 22.10.2017.
 */
$("#buy").on("click", function () {
    $.ajax({
        url:"../../core/Product.php",
        type:"get",
        data:({buy:true}),
        dataType:"json",
        success:function(data){
            if(data === true)
            {
                $("#numb").text(function () {
                    return $("#numb").text() - 1;
                })
            }
            else if(data < 0)
            {
                $("#buy").remove();
            }
            else{
                alert('Ошибка! Что-то пошло не так!');
            }
        }
    })
});
$("#edit").on("click", function () {
    $.ajax({
        url:"../../core/Product.php",
        type:"get",
        data:({edit:true}),
        dataType:"json",
        success:function(){
            $(location).attr("href", 'newProduct.php');
        }
    })
});