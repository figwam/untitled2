<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>index</title>
    <link rel="stylesheet" href="view/css/index.css">
    <link rel="stylesheet" href="view/css/exit.css">
    <script src="libs/jquery-3.2.1.min.js"></script>
    <script src="view/js/function.js"></script>
</head>
<body>
    <div id="window">
        <div id="header">ПЕРЕЧЕНЬ ВСЕХ СТРАНИЦ
            <?php
            if(isset($_SESSION['user']))
                echo "<a href='#' id='exit' class='a' style='position: relative;right: -300px;'>Выход</a>"
            ?>
        </div>
        <div id="href">
            <div id="logIn""><a class="submit" href="view/pages/logIn.php">Войти</a></div>
            <div id="signUp"><a class="submit" href="view/pages/signup.php">Зарегистрироваться</a></div>
            <div id="newProd"><a class="submit" href="view/pages/newProduct.php">Добавить товар</a></div>
            <div id="shopWindow"><a class="submit" href="view/pages/shopWindow.php">Посмотреть весь товар</a></div>
            <div id="userPage"><a class="submit" href="view/pages/userPage.php">Кабинет пользователя</a></div>
            <div class="submit">Есть ещё страница товара</div>
        </div>
    </div>
    <script>
        exit("core/Users.php", "index.php");
    </script>
</body>
</html>
