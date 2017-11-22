<?php
/**
 * Created by PhpStorm.
 * User: figwam
 * Date: 19.10.2017
 * Time: 22:48
 */
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Витрина</title>
    <link rel="stylesheet" href="../css/shopWindow.css">
    <link rel="stylesheet" href="../css/productArr.css">
    <link rel="stylesheet" href="../css/exit.css">
    <script src="../../libs/jquery-3.2.1.min.js"></script>
    <script src="../js/function.js"></script>
</head>
<body>
<div id="header">
    <?php
        if(isset($_SESSION['user']))
        {
            echo "<div id=\"room\" class=\"submit\">Кабинет пользователя ".$_SESSION['user']['name']."</div>";
        }
        else
        {
            ?>
            <a class="a" href="signup.php">Регистрация</a>
            <a class="a" href="logIn.php">Авторизация</a>
            <?php
        }
    ?>
</div>
    <div id="window">
        <div id="shopHeader">
            <div>Сортировать по:</div>
            <div id="nameSort" class="sort">Название</div>
            <div id="priceSort" class="sort">Цена</div>
            <div id="dateSort" class="sort">Дата</div>
        </div>
        <div id="shop">
        </div>
        <div class='submit'>Добавить</div>
    </div>
    <script src="../js/shopWindow.js"></script>
</body>
</html>
