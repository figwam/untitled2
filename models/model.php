<?php

class model
{
    /*
     * Поиск строк
     * $assoc - ассоциативный массив, где ключ - имя домена,
     * значение - значение домена
     * $type - тип поиска ("OR" или "AND")
     * Вернёт массив найденых строк или -1
     */
    static public function searchString($assoc, $table, $type = 'AND')
    {
        $query = "SELECT * 
                  FROM ".DB_NAME.".$table 
                  WHERE ";
        foreach ($assoc as $key => $val)
            $query .= "`$key` = '$val' $type ";
        $query = substr_replace($query, ';',strlen($query)-strlen($type)-2,strlen($type)+1);
        return model::query($query);
    }
    /*
     * Поиск в домене $domain значения $value
     */
    static public function searchField($value, $domain, $table)
    {
        $query = "SELECT *
                  FROM `".DB_NAME."`.`$table`
                  WHERE `$domain` = '$value'";
        return self::query($query);
    }
    /*
     * Запрос в базу данных, вернёт массив
     */
    static public function query($query)
    {
        $base = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);
        $result = $base->query($query);
        $base->close();
        while($array[] = mysqli_fetch_array($result, MYSQLI_ASSOC));
        array_pop($array);
        return $array;
    }
    /*
     * Использовать для добавления строки в базу
     */
    static public function insert($query)
    {
        $base = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME, DB_PORT);
        $base->query($query);
        $base->close();
    }
}