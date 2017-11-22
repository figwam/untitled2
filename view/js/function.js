//ajax - проверка на корректность поля field
function checkField(field, field_2) {
    var str = "#" + field,//
        status = '.status .' + field;
    if(field_2)
    {
        str += ", #" + field_2;
        status += ", .status ." + field_2;
    }

    $(str).on("focus", function(){
        $(status).removeClass('before defeat success');
        $(str).on("focusout", function(){
            if(!$("#" + field).val())
            {
                $(status).addClass("defeat");
            }
            else if(field_2 && ($("#" + field).val() == '' || $("#" + field_2).val() == ''
                || $("#" + field).val() != $("#" + field_2).val()))
            {
                $(status).addClass("defeat");
            }
            else
            {
                $.ajax({
                    url:"../../core/Users.php",
                    type:"GET",
                    data:({
                        name:field,
                        field:$("#" + field).val()
                    }),
                    dataType:"json",
                    beforeSend:function(){
                        $(status).addClass("before");
                    },
                    success:function(result){
                  //      alert(result);
                        $(status).removeClass('before');
                        if(result)
                            $(status).addClass("success");
                        else
                            $(status).addClass("defeat");
                    }
                });
            }
        });
    });

}

/*
    Указывает тип сортировки в шапке (для shopWindow)
 */
function sortType(element)
{
    $(element).on('click', function () {
        $("#shop").empty();
        fieldName = element;
        numberItems = 0;
        var className = ["#nameSort", "#priceSort", "#dateSort"];
        var str = '';
        if($(element).hasClass("ascent"))
        {
            $(element).removeClass("ascent");
            $(element).addClass("waning");
            typeFlag = "waning";
        }
        else if($(element).hasClass("waning"))
        {
            $(element).removeClass("waning");
            $(element).addClass("ascent");
            typeFlag = "ascent";
        }
        else
        {
            $(element).addClass("ascent");
            typeFlag = "ascent";
        }
        for(var i = 0; i < className.length; i++)
        {
            if(className[i] != element)
            {
                if(str != '')
                    str += ", ";
                str += className[i];
            }
        }
        $(str).removeClass("ascent waning");
        loadProduct(element, typeFlag);
    });
}
/*
    делает запрос в таблицу продуктов,
    sortField - поле сортировки
    sortType - тип сортировки
    start - количество пропускаемых продуктов (для LIMIT)
    where - условие, где
        'sale' - вернёт список продаваемых товаров зарегистрированного пользователя
        'shop' - вернёт список покупок зарегистрированного пользователя
        undefined || false - вернёт товары без привязки к пользователю
    serverName - имя сервера
 */
function loadProduct(sortField, sortType, start, where, serverName) {
    serverName = serverName || "../../core/Product.php";
    start = start || '0';
    sortType = sortType || 'ascent';
    sortField = sortField || 'date';
    where = where || 'false';
    $.ajax({
        url:serverName,
        type:'POST',
        data:({
            flag:'shop',
            field:sortField,
            sort:sortType,
            start:start,
            where: where
        }),
        dataType:"json",
        success:function (data) {
            if(!data || numbProduct > data['products'].length)
                $("#window .submit").remove();
            fieldName = sortField;
            numberItems += data['products'].length;
            arrayData = arrayData.concat(data['products']);

             // alert(numbProduct + " > " + data['products'].length);

            if(data['users'])
                viewProduct(data);
            else
                viewSaleUser(data['products']);

            $(".product").on('click', function(){
                goProduct(arrayData[$(this).index()]['id']);
            });
            numbProduct = data['products'].length;
        }
    });
}
/*
    Добавдяет в конец блока #shop новые позиции продуктов
    data - массив продуктов и их продавцов
        data['products'] - продукты
        data['users'] - пользователи
 */
function viewProduct(data)
{
    // var vs;
    // for(data['users'][0] in $key)
    // {
    //     // vs += $key + ", ";
    // }
    // alert(data['users'][0]['name']);
    for(var i = 0; i < data['products'].length; ++i)
    {
        var index = find(data['users'], data['products'][i]['idUser']);//поиск индекса пользователя
        if(index == -1)
            continue;
        var time = new Date(data['products'][i]['image'].split('.')[0] * 1000);
        var date = time.getFullYear() +"-"+ time.getMonth()+"-"+time.getDate() +
                " "+time.getHours()+":"+time.getMinutes();

        var description = data['products'][i]['description'];
        if(description.length > 119)
            description = description.substr(0, 119) + "...";

        $("#shop").append(
        "<div class='product'>" +
            "<div class='image'  style='background-image: url(\"../../usersFiles/"+data['products'][i]['image']+"\")'></div>" +
            "<div class='properties'>" +
                "<div class='string'>" +
                    "<div class='name'>"+data['products'][i]['name']+"</div>" +
                    "<div class='price'>"+data['products'][i]['price_BYN']+" руб.</div>" +
                "</div>" +
                "<div class='string'>" +
                    "<div class='date'>"+date+"</div>" +
                    "<div class='quantity'>В наличии "+data['products'][i]['quantity']+" шт.</div>" +
                "</div>" +
                "<div class='contacts'>" +
                    "<div class='nameUser'>Имя: " + data['users'][index]['name'] +"</div>" +
                    "<div class='phone'>Телефон: " + data['users'][index]['phone'] +"</div>" +
                    "<div class='email'>Почта: " + data['users'][index]['email'] +"</div>" +
                "</div>" +
                "<div class='description'>"+description+"</div>" +
            "</div>" +
        "</div>"
        );
    }
}
/*
    Показ продаваемых товаров пользователя (без контактов)
    где data - массив продуктов
 */
function viewSaleUser (data)
{
    for(var i = 0; i < data.length; ++i)
    {
        var time = new Date(data[i]['image'].split('.')[0] * 1000);
        var date = time.getFullYear() +"-"+ time.getMonth()+"-"+time.getDate() +
            " "+time.getHours()+":"+time.getMinutes();

        var description = data[i]['description'];
        if(description.length > 200)
            description = description.substr(0, 200) + "...";
        $("#shop").append(
            "<div class='product'>" +
                "<div class='image'  style='background-image: url(\"../../usersFiles/"+data[i]['image']+"\")'></div>" +
                "<div class='properties'>" +
                    "<div class='string'>" +
                        "<div class='name'>"+data[i]['name']+"</div>" +
                        "<div class='price'>"+data[i]['price_BYN']+" руб.</div>" +
                    "</div>" +
                    "<div class='string'>" +
                        "<div class='date'>"+date+"</div>" +
                        "<div class='quantity'>В наличии "+data[i]['quantity']+" шт.</div>" +
                    "</div>" +
                    "<div class='descriptionSale'>"+description+"</div>" +
                "</div>" +
            "</div>"
        );
    }
}
/*
    осуществляет переход на страницу товара
    idProduct - id продукта
 */
function goProduct(idProduct, serverName)
{
    serverName = serverName || "../../core/Product.php";
    $.ajax({
        url:serverName,
        type:'POST',
        data:({
            flag:'session',
            id:idProduct
        }),
        dataType:"json",
        success: function (data) {
            if(data)
                $(location).attr('href',"pageProduct.php");
            else
                alert("Ошибка: что-то пошло не так!")
        }
    });
}

/*
    Поиск по двумерному массиву пользователей. Вернёт индекс или -1
 */
function find(array, value, domain)
{
    domain = domain || 'idUsers';
    for (var i = 0; i < array.length; ++i)
        if(array[i][domain] == value)
            return i;
    return -1;
}
/*
    Осуществляет выход из аккаунта
    serverName - адрес сервера
    href - адрес перенаправления после выхода
 */
function exit(serverName, href)
{
    $("#exit").on('click', function(){
        $.ajax({
            url:serverName,
            data:({exit:true}),
            type:"GET",
            success:function (data) {
                if(data)
                    $(location).attr('href',href)
            }
        });
    });
}