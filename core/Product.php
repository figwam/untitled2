<?php
session_start();
require_once "../models/model.php";
require_once "../controllers/users.php";
require_once "../config.php.ini";
require_once "../controllers/product.php";
require_once "../controllers/shop.php";

$data = $_POST;
$get = $_GET;
//Добавление продукта в базу
if(isset($data['edit']))
{
    echo json_encode(product::editProduct($_FILES,$data,$_SESSION['edit']));
    unset($_SESSION['edit']);
    exit;
}
/*
 * Регистрация товара
 */
if(isset($_FILES['image']))
{
    echo json_encode(product::addProduct($_FILES,$data,$_SESSION['user']['idUsers']));
}
/* Возвращает массив товаров, где
 */
if(@$data['flag'] == 'shop')
{
    //Вернёт список покупок зарегистрированного пользователя
    if(@$data['where'] == 'shop')
    {
        $arr['products'] = product::getPurchases($data['start'],$_SESSION['user']['idUsers']);
        $arr['users'] = product::getSellers($arr['products']);
        echo json_encode($arr);
        exit;
    }
    //Вернёт список продаваемых товаров зарегистрированного пользователя
    elseif (@$data['where'] == 'sale')
    {
        $array['products'] = product::sale($_SESSION['user']['idUsers'], $data['start']);
        $array['users'] = false;
        echo json_encode($array);
        exit;
    }

    if(preg_match("/id(?=.*)|.*date(?=.*)/iu", $data['field']))
        $field = 'id';
    elseif (preg_match("/.*price(?=.*)/iu", $data['field']))
        $field = 'price_BYN';
    else
        $field = 'name';

    $arr['products'] = product::shop($field,$data['start'], $data['sort'], 1);
    if(isset($arr['products']))
        $arr['users'] = product::getSellers($arr['products']);
    else
    {
        echo json_encode(false);
        exit;
    }
    echo json_encode($arr);
}
/*
 * Сохранение в сессию id запрашиваемого продукта
 */
if(isset($data['flag']) && @$data['flag'] == 'session')
{
    $_SESSION['id'] = $data['id'];
    echo json_encode(true);
}
/*
 * Покупка
 */
if(isset($get['buy']))
{
    $result = product::readyProduct($_SESSION['id'], 1);
    if($result !== false)
    {
        shop::buy($_SESSION['user']['idUsers'], $_SESSION['id'], 1);
        echo json_encode($result);
        exit;
    }
    if($result == -1)
    {
        echo json_encode(-1);
        exit;
    }
    echo json_encode(false);
    exit;
}
//Сохраняет свойства продуктв в сессию для дальнейшего редактировнаия
if(isset($get['edit']))
{
    $_SESSION['edit'] = product::getProduct($_SESSION['id']);
    echo json_encode(true);
}

?>
