<?php
/**
 * Created by PhpStorm.
 * User: figwam
 * Date: 20.10.2017
 * Time: 18:26
 */
session_start();
require_once "../../models/model.php";
require_once "../../controllers/users.php";
require_once "../../config.php.ini";
require_once "../../controllers/product.php";

//$prod = product::getProduct($_SESSION['idProd']);
$_prod = product::getProduct($_SESSION['id']);

$_seller = product::getSellers(array($_prod))[0];
$time = explode(".",$_prod['image'])[0];
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php
        if(!$_prod)
            echo "<title>Ошибка 404: страница не найдена!</title>";
        else
            echo "<title>".$_prod['name']."</title>";
    ?>
    <title>Продукт</title>
    <link rel="stylesheet" href="../css/pageProduct.css">
    <link rel="stylesheet" href="../css/exit.css">
    <script src="../../libs/jquery-3.2.1.min.js"></script>
</head>
<body>
<?php
    if(!$_prod) {
        ?>
        <div id="error">
            Ошибка 404: страница не найдена!
        </div>
        <?php
    }
    else {
        ?>
        <div id="header">
            <a href="shopWindow.php" class="a">На главную</a>
        </div>
        <div id="product">
            <div id="properties">
                <div id="image" style="background-image: url('../../usersFiles/<?php echo $_prod['image'] ?>')"></div>
                <div id="th">
                    <div id="left">
                        <div id="name"><?php echo $_prod['name'] ?></div>
                        <div id="date"><?php echo date("Y-m-d H:i", $time) ?></div>
                    </div>
                    <div id="right">
                        <div id="price"><?php echo $_prod['price_BYN'] ?> руб.</div>
                        <?php
                            if(isset($_SESSION['user']))
                            {
                                if($_prod['idUser'] != $_SESSION['user']['idUsers'])
                                {
                                    if($_prod['status'] == 1)
                                        echo "<input id=\"buy\" class=\"button\" type=\"submit\" value=\"Купить\">";
                                }
                                else
                                    echo "<input id=\"edit\" class=\"button\" type=\"submit\" value=\"Редактировать\">";
                            }
                        ?>
                        <div id="quantity"> В наличии <span id="numb"><?php echo $_prod['quantity'] ?></span> шт.</div>
                    </div>
                    <div class='contacts'>
                        <div class='nameUser'><?php echo $_seller['surname']." ".$_seller['name']." ".$_seller['secondName'] ?></div>
                        <div class='phone'><?php echo $_seller['phone'] ?></div>
                        <div class='email'><?php echo $_seller['email'] ?></div>
                        </div>
                </div>
                <div id="desName">Описание</div>
                <div id="description"><?php echo $_prod['description'] ?></div>
            </div>
        </div>
        <?php
    }
?>
<script src="../js/pageProduct.js"></script>
</body>
</html>
