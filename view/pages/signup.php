<?php
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Регистрация</title>
    <link rel="stylesheet" href="../css/Accounts.css">
    <script src="../../libs/jquery-3.2.1.min.js"></script>
    <script src="../js/function.js"></script>
</head>
<body>
<div class="form">
    <form>
        <p class="head">Регистрация</p>
        <div class="label">
            <label for="firstName">Имя:</label>
            <label for="surname">Фамилия:</label>
            <label for="secondName">Отчество:</label>
            <label for="email">email:</label>
            <label for="phone">Телефон:</label>
            <label for="firstPass">Пароль:</label>
            <label for="secondPass">Повторите пароль:</label>
        </div>
        <div class="input">
            <input id="firstName" type="text">
            <input id="surname" type="text">
            <input id="secondName" type="text">
            <input id="email" type="email">
            <input id="phone" type="text" value="+375 ">
            <input id="firstPass" type="password">
            <input id="secondPass" type="password">
        </div>
        <div class="status">
            <div class="st firstName"></div>
            <div class="st surname"></div>
            <div class="st secondName"></div>
            <div class="st email"></div>
            <div class="st phone"></div>
            <div class="st firstPass"></div>
            <div class="st secondPass"></div>
        </div>
    </form>
    <div class="but"><button id="button" type="submit">Отправить</button></div>
</div>
<script src="../js/signup.js"></script>
</body>
</html>
