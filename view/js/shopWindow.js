/**
 * Created by figwam on 20.10.2017.
 */
var numberItems = 0,//количество товаров на странице
    arrayData = [],//массив товаров
    numbProduct = 0, //количество товаров в предпоследней выборке
    typeFlag ='ascent',//тип сортировки
    fieldName;//поле сортировки
sortType("#nameSort");
sortType("#priceSort");
sortType("#dateSort");
exit("../../core/Users.php", "shopWindow.php");
$(document).ready(function () {
    loadProduct();
    $("#window .submit").on('click', function () {
         // alert(fieldName + ", " + typeFlag + ", " +numberItems);
        loadProduct(fieldName,typeFlag,numberItems);
    });
    $("#room").on("click", function () {
        $(location).attr('href', "userPage.php");
    });
});