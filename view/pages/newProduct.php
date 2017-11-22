<?php
/**
 * Created by PhpStorm.
 * User: figwam
 * Date: 18.10.2017
 * Time: 16:07
 */
    session_start();
    if(isset($_SESSION['edit']['quantity']))
        $numb = $_SESSION['edit']['quantity'];
    else
        $numb = 1;
?>
<!--Страница регистрации товара-->
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php
        if(isset($_SESSION['user']))
            echo "<title>Редактор товара</title>";
        else
        {
            echo "<title>Ошибка 404: страница не найдена!</title>
                  <div id='error'>
                      Войдите или зарегистрируйтесь!
                  </div>";
            exit;
        }
    ?>
    <link rel="stylesheet" href="../css/newProduct.css">
    <script src="../../libs/jquery-3.2.1.min.js"></script>
</head>
<body>
<div id="header">
    <?php
        echo "<div id=\"room\" class=\"submit\">Кабинет пользователя ".$_SESSION['user']['name']."</div>";
    ?>
    <div id="nameUser">
        <?php
        echo $_SESSION['user']['name'];
        ?>
    </div>
</div>
<div class="form">
    <form id="form" enctype="multipart/form-data">
        <p class="head">
            <?php
                if(!isset($_SESSION['edit']))
                    echo "Регистрация товара";
                else
                    echo "Редактирование товара";
            ?>
        </p>
        <div class="label">
            <label for="name">Название:</label>
            <label for="prices">Цена:</label>
            <label for="quantity">Количество:</label>
            <label for="image">Изображение:</label>
        </div>
        <div class="input">
            <input id="name" name="name" type="text" value="<?php echo @$_SESSION['edit']['name'];?>">
            <input id="prices" name="prices" type="number" min="0" value="<?php echo @$_SESSION['edit']['price_BYN'];?>">
            <div id="quantity">
                <input id="slider" name="slider" type="range" min="1" max="100" step="1" value="<?php echo @$numb;?>">
                <input id="numb" name="numb" type="text" value="<?php echo @$numb;?>">
            </div>
            <input id="image" name="image" type="file" accept="image/jpeg, image/png, image/gif">
        </div>
        <label for="description" id="dis">
            <p>Описание:</p>
            <textarea id="description" name="description"><?php echo @$_SESSION['edit']['description']; ?></textarea>
        </label>

    </form>
    <?php
        if(isset($_SESSION['edit']))
            echo "<div class=\"but\"><button id=\"edit\" type=\"submit\">Отправить!</button></div>";
        else
            echo "<div class=\"but\"><button id=\"button\" type=\"submit\">Отправить</button></div>";
    ?>
</div>
<script src="../js/newProduct.js"></script>
</body>
</html>
