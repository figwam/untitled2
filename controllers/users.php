<?php
class users
{
    static public $passLen = 4;//минимальная длина пароля
    /*
     * Поиск пользователей по массиву id
     */
    static public function searchUsers($arrayId)
    {
        $query = "SELECT * 
                  FROM `".DB_NAME."`.`users`
                  WHERE";
        for ($i = 0; $i < count($arrayId); ++$i)
        {
            $query .= " `idUsers` = ".$arrayId[$i];
            if($i < count($arrayId) - 1)
                $query .= " OR";
            else
                $query .= ";";
        }
        return model::query($query);
    }
    /*
     * Ищет в таблице сощетание номера телефона или почты и пароля
     * $array - ассоциативный массив, где:
     *      'phoneEmail' - номер телефона или почта
     *      'password' - пароль
     * В случае успеха вернёт вектор свойств пользователя
     */
    static public function logIn ($array)
    {
        $array['phoneEmail'] = preg_replace("/\s+/",'',$array['phoneEmail']);
        if(!preg_match("/[^\+\d]/", $array['phoneEmail']) && strlen($array['phoneEmail']) >= 13)
        {
            $string = @model::searchField($array['phoneEmail'],'phone', 'users')[0];
            if($string && password_verify($array['password'], $string['password']))
                return $string;
            return false;
        }
        else
        {
            if(self::checkSpelling($array['phoneEmail'], 'email'))
            {
                $string = @model::searchField($array['phoneEmail'],'email', 'users')[0];
                if($string && password_verify($array['password'], $string['password']))
                    return $string;
                return false;
            }
            else
                return false;
        }
    }
    /*
     * Регистрация пользователя
     * $array - ассоциативный массив свойств пользователя
     * в случае успеха вернёт 0
     * иначе - ошибку
     */
    static public function addUser($array)
    {
        if(!$errors = self::checkArrUser($array))
        {
            $domain = "(";
            $values = "(";
            $i = 0;
            foreach ($array as $key => $val)
            {
                if(strtoupper($key) == 'PASSWORD' || strtoupper($key) == 'FIRSTPASS' || strtoupper($key) == 'SECONDPASS')
                {
                    if($i != 0)
                        continue;
                    $domain .= "`password`, ";
                    $values .= "'".password_hash($val, PASSWORD_DEFAULT)."', ";
                    ++$i;
                    continue;
                }
                elseif(strtoupper($key) == 'NAME' || strtoupper($key) == 'FIRSTNAME')
                {
                    $domain .= "`name`, ";
                    $values .= "'".$val."', ";
                    continue;
                }
                elseif(strtoupper($key) == 'PHONE' || strtoupper($key) == 'EMAIL')
                    $val = preg_replace("/\s+/",'',$val);
                $domain .= "`".$key."`, ";
                $values .= "'".$val."', ";
            }
            $domain = substr_replace($domain, ')',strlen($domain)-2,2);
            $values = substr_replace($values, ');',strlen($values)-2,2);

            $query = "INSERT INTO `".DB_NAME."`.`users` $domain 
                        VALUES $values";
            model::insert($query);
            return false;
        }
        else
        {
        //   print_r($errors);
            return $errors;
        }
    }
    /* Для таблицы "users"
     * Делает проверку массива переменных на корректность
     * Вернёт массив ошибок или 0 если ошибок нет
     */
    static public function checkArrUser($array)
    {
        $errors = array();
        foreach ($array as $key => $val)
            if(!users::checkOneUser($key, $val))
                $errors[$key] = $val;
        //проверка на совпадение паролей
        if(@$array['firstPass'] != @$array['secondPass'])
            $errors['password'] = 1;

        if(count($errors))
            return $errors;

        $assoc = array();
        foreach ($array as $key => $val)
        {
            $key = strtoupper($key);
            if ($key == "EMAIL")
                $assoc['email'] = $val;

            elseif ($key == 'PHONE')
                $assoc['phone'] = $val;
        }
        //поиск в БД
        $result = model::searchString($assoc, 'users', 'OR');
        for ($i = 0; $i < count($result); ++$i)
        {
            foreach ($assoc as $key => $val)
            {
                if(strtoupper($result[$i][$key]) == strtoupper($val))
                    $errors[$key] = $val;
            }
        }
        if(count($errors))
            return $errors;
        return 0;
    }
    /* Для таблицы "users"
     * Делает проверку переменной $val в зависимости от его имени $key
     * Вернёт 1 если поле $key со значением $val корректно
     */
    static public function checkOneUser($key, $val)
    {
        $key = strtoupper($key);
        if($key == "FIRSTPASS" || $key == "SECONDPASS" || $key == 'PASSWORD')
            return self::checkSpelling($val, 'PASSWORD');

        elseif ($key == "EMAIL")
        {
            if(self::checkSpelling($val, 'email') && !isset(model::searchField($val,'email', 'users')[0]))
                return true;
            else
                return false;
        }

        elseif ($key == 'PHONE')
        {
            if(self::checkSpelling($val, 'phone') && !isset(model::searchField($val,'phone', 'users')[0]))
                return true;
            else
                return false;
        }

        else
            return self::checkSpelling($val);
    }
    /*
     * Проверяет правописание в зависимости от типа поля
     */
    static public function checkSpelling($field,$type = 'TEXT')
    {
        $type = strtoupper($type);
        if($type == 'EMAIL')
            return preg_match("/^[a-z0-9а-яё]+@[a-z0-9а-яё]+\.[a-z0-9а-яё]+$/iu", $field);

        elseif ($type == 'PASSWORD')
        {
            if(strlen($field) < self::$passLen)
                return false;
            if(preg_match("/[^\w\dа-яё ]/iu", $field))
                return false;
            else
                return true;
        }
        elseif($type == 'PHONE')
        {
            $field = preg_replace("/\s+/",'',$field);
            if(strlen($field) < 13)
                return false;
            if(preg_match("/^\+\d{12,}/u", $field) && !preg_match("/[^\+0-9]/u", $field))
                return true;
            else
                return false;
        }
        elseif($type == 'TEXT')
        {
            if(!$field || preg_match("/[^a-zа-яё ]/iu", $field))
                return false;
            else
                return true;
        }
    }
}