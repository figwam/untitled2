/**
 * Created by figwam on 21.10.2017.
 */
var numberItems,//количество товаров на странице
    arrayData,//массив товаров
    numbProduct; //количество товаров в предпоследней выборке
$(".menuButton").on('click', function () {
    arrayData = [];
    numbProduct = 0;
    numberItems = 0;
    $("#shop").empty();
    $("body").find(".active").removeClass('active');
    $(this).addClass("active");
    var id = $(this).attr("id");
    //Продажи
    if(id == 'sale')
    {
        loadProduct('date','ascent', 0, 'sale');
        $("#window .submit").on('click', function () {
            loadProduct('date','ascent', numbProduct, 'sale');
        });
    }
    //Покупки
    else if(id == 'shots')
    {
        loadProduct('date','ascent', 0, 'shop');
        $("#window .submit").on('click', function () {
            loadProduct('date','ascent', numbProduct, 'shop');
        });
    }
});
$("#sell").on('click', function () {
    $(location).attr('href', "newProduct.php");
});
exit("../../core/Users.php", "shopWindow.php");
