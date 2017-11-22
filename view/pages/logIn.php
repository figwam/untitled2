<?php
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Авторизация</title>
    <link rel="stylesheet" href="../css/Accounts.css">
    <script src="../../libs/jquery-3.2.1.min.js"></script>
</head>
<body>
<div class="form">
    <form>
        <p class="head">Авторизация</p>
        <div class="label">

            <label for="phoneEmail">Телефон или почта:</label>
            <label for="password">Пароль:</label>
        </div>
        <div class="input">

            <input id="phoneEmail" type="text" value="">
            <input id="password" type="password">
        </div>
        <div class="status">
            <div class="st phoneEmail"></div>
            <div class="st password"></div>
        </div>
    </form>
    <div class="but"><button id="button" type="submit">Отправить</button></div>
</div>
<script src="../js/logIn.js"></script>
</body>
</html>
