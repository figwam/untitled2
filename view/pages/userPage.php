<?php
/**
 * Created by PhpStorm.
 * User: figwam
 * Date: 21.10.2017
 * Time: 12:46
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
    <?php
        if(isset($_SESSION['user'])) {
            echo "<title>".$_SESSION['user']['name']."</title>";
        }
        else
        {
            echo "<title>Ошибка 404: страница не найдена!</title>
                  <div id='error'>
                      Войдите или зарегистрируйтесь!
                  </div>";
            exit;
        }
    ?>
    <script src="../../libs/jquery-3.2.1.min.js"></script>
    <script src="../js/function.js"></script>
    <link rel="stylesheet" href="../css/userPage.css">
    <link rel="stylesheet" href="../css/productArr.css">
    <link rel="stylesheet" href="../css/exit.css">
</head>
<body>
    <div id="window">
        <div id="header">
            <div id="name">
                <?php
                    echo $_SESSION['user']['name'];
                ?>
            </div>
            <?php
            echo "<a href='#' id='exit' class='a' style='position: relative;right:-850px;'>Выход</a>";
            ?>
            <a class="a" href="shopWindow.php">На главную</a>
        </div>
        <div id="menu">
            <div class="menuButton" id="shots">Покупки</div>
            <div class="menuButton" id="sale">Продажи</div>
            <div id="sell" class="buttonMenu">Добавить товар</div>
        </div>
        <div id="shop"></div>
        <div class='submit'>Добавить</div>
    </div>
    <script src="../js/userPage.js"></script>
</body>
</html>
