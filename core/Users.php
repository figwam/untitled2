<?php
session_start();
require_once "../models/model.php";
require_once "../controllers/users.php";
require_once "../config.php.ini";
    $data = $_GET;
    //быстрая проверка поля
    if(isset($data['name']))
    {
        echo json_encode(users::checkOneUser($data['name'], $data['field']));
    }

    //регистрация пользователя
    if(isset($data['object']))
    {
        $error = users::addUser($data['object']);
        if(!$error)
        {
            //Регистрация прошла, теперь авторизация
            $_SESSION['user'] = users::logIn(array('phoneEmail' => $data['object']['phone'], 'password' => $data['object']['firstPass']));
            echo json_encode(false);
            exit;
        }
        echo json_encode($error);

    }

    //Авторизация пользователя
    if(isset($data['autho']))
    {
        $result = users::logIn($data['autho']);
        if($result)
        {
            $_SESSION['user'] = $result;
            echo json_encode(true);
        }
        else
            echo json_encode(false);
    }

    //Выход
    if(isset($data['exit']))
    {
        session_destroy();
        echo json_encode(true);
    }
?>