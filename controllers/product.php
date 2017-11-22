<?php

/**
 * Created by PhpStorm.
 * User: figwam
 * Date: 19.10.2017
 * Time: 14:10
 */
class product
{
    /*
     * Вернёт массив покупок пользователя id которого равен $idUser,
     * отсортированных по дате, с пропуском $start
     */
    static public function getPurchases ($start, $idUser, $sortType = 'desc')
    {
        $query = "SELECT * FROM `".DB_NAME."`.`products`, `".DB_NAME."`.`shop`
                  WHERE `".DB_NAME."`.`shop`.`idUser` = $idUser 
                  AND `".DB_NAME."`.`products`.`id` = `".DB_NAME."`.`shop`.`idshop`
                  ORDER BY `id` $sortType
                  LIMIT $start, ".SHOP_LIMIT.";";
        return model::query($query);
    }
    /*
     * Найдёт всех продавцов для массива продуктов, где
     * products - продукты
     * users - продавцы
     * $products - массив продуктов
     */
    static public function getSellers($products)
    {
        if(!$products)
            return false;
        $idUser = array();
        $numb = 0;
        for ($i = 0; $i < count($products); ++$i)
        {
            if(array_search($products[$i]['idUser'], $idUser) === false)
            {
                $idUser[$numb] = $products[$i]['idUser'];
                unset($products[$i]['password']);
                ++$numb;
            }
        }
        return users::searchUsers($idUser);
    }
    /*
     * Вернёт вектор свойств продукта по его id
     */
    static public function getProduct($id)
    {
        $query = "SELECT * FROM `".DB_NAME."`.`products`
                  WHERE `id` = $id";
        $result = model::query($query);
        if($result)
            return $result[0];
        return false;
    }
    /*
     * Вернёт массив продуктов отсортированных по домену $sortField,
     * согласно типу сортировки $sortType,
     * начиная с $start и длиной SHOP_LIMIT
     * и со $status равным 0 или 1 или all (1 - в продаже)
     */
    static public function shop ($sortField, $start, $sortType = 'desc', $status = '1')
    {
        if(preg_match("/asc(?=.*)*/iu", $sortType))
            $sType = 'asc';
        else
            $sType = 'desc';
        $query = "SELECT * FROM `".DB_NAME."`.`products`";

        if(!preg_match("/all*/iu", $status))
            $query .= " WHERE `status` = $status";

        $query .= " ORDER BY `$sortField` $sType
                  LIMIT $start, ".SHOP_LIMIT.";";
        return model::query($query);
    }
    /*
     * Вернёт массив продаваемых (или проданых) продуктов отсортированных по дате
     * где $idUser - id продавца
     * $start - пропуск
     */
    static public function sale ($idUser, $start)
    {
        $query = "SELECT * FROM `".DB_NAME."`.`products`
                  WHERE `idUser` = $idUser
                  ORDER BY `id` DESC
                  LIMIT $start, ".SHOP_LIMIT.";";
        return model::query($query);
    }
    /*
     * assoc - новый свойства продукта (форма)
     * image - файл
     * id - id товара
     * $imageName - старое имя изображения
     * $product - старые свойства продукта
     */
    static public function editProduct (&$image, &$assoc, &$product, $place = "../usersFiles/")
    {
        $data = array('name' => $assoc['name'], 'quantity' => $assoc['slider'],
            'price_BYN' => $assoc['prices'], 'description' => $assoc['description'], 'status' => 1);
        if(isset($image['image']))
        {
            $NewImageName = self::loadFile($image, $place);
            if(@$NewImageName)
            {
                //удаление старого изображения
                @unlink($place.$product['image']);
                $data['image'] = $NewImageName;
            }
        }

        return self::update($data, $product['id']);
    }
    /*
     * Меняет свойства продукта с id = $id, свойства из массива $assoc
     */
    static public function update (&$assoc, $id)
    {
        $update = "UPDATE `".DB_NAME."`.`products`
                      SET ";
        foreach ($assoc as $key => $value)
            $update .= "$key = '$value',";

        $update = substr($update,0,strlen($update) - 1);
        $update .= " WHERE `id` = $id;";
        model::insert($update);
        return true;
    }
    /*
     * Уменьшает количество товара на значение $increment
     */
    static public function readyProduct ($idProduct, $increment)
    {

        $product = self::getProduct($idProduct);
        if($product)
        {
            if($product['quantity'] - $increment > 0)
            {
                $query = "UPDATE `".DB_NAME."`.`products`
                          SET `quantity` = ".($product['quantity'] - $increment)."
                          WHERE `id` = $idProduct;";
            }
            else
            {
                $query = "UPDATE `".DB_NAME."`.`products`
                          SET `quantity` = ".($product['quantity'] - $increment).", `status` = 0
                          WHERE `id` = $idProduct;";
                model::insert($query);
                return -1;
            }
            model::insert($query);
            return true;
        }
        return false;
    }

    /*
     * Сохранение товара с сохранением его изображения
     *      $image - изображение
     *      $properties - свойства товара (передавать массивы $_POST/$_GET)
     *      $idUser - id владельца
     *      $place - путь
     */
    static public function addProduct (&$image, &$properties, $idUser, $place = "../usersFiles/")
    {
        $assoc = array();
        foreach ($properties as $key => $val)
        {
            $k = strtoupper($key);
            if ($k == 'QUANTITY' || $k == 'SLIDER')
            {
                $assoc['quantity'] = $properties[$key];
                continue;
            }
            elseif ($k == 'NUMB')
                continue;
            $assoc[$key] = $properties[$key];
        }
        $imageName = self::loadFile($image, $place);
        if(!$imageName)
            return false;
        $assoc['image'] = $imageName;
        $assoc['idUser'] = $idUser;
        return self::saveProperties($assoc);
    }
    /*
     * Сохранение свойств товара в базу данных
     * $assoc - массив со свойствами товара
     *      'idUser' - id владельца товара
     *      'name' - название товара
     *      'prices' - цена товара
     *      'description' - описание товара
     *      'quantity' - количество единиц товара
     *      'image' - имя товара
     */
    static private function saveProperties (&$assoc)
    {
        //проверка, что все поля заполнены, и сверяется размер описания с порогом
        if(@$assoc['idUser'] !='' && @$assoc['name'] !='' && @$assoc['prices'] !='' && @$assoc['description']
            && @$assoc['description'] !='' && @$assoc['quantity'] !='' && @strlen($assoc['description']) < 65000)
        {
            $query = "INSERT INTO `".DB_NAME."`.`products` (`idUser`, `name`, `quantity`,`price_BYN`,`description`,`image`)
                  VALUES ('".$assoc['idUser']."','".$assoc['name']."','".$assoc['quantity']."','".$assoc['prices']."','".$assoc['description']."','".$assoc['image']."');";
            model::insert($query);
            return true;
        }
        return false;
    }
    /*
     * Сохраняет файл на сервер
     * в случае успеха вернёт его новое имя, иначе - false
     */
    static private function loadFile (&$file, $place = "../usersFiles/",  $name = "image", $type = 'image')
    {
        if($type == 'image' && preg_match("/^image\/(?=(gif$)|(png$)|(jpg$)|(jpeg$))/iu", $file[$name]['type'])
            && $_FILES['image']['size'] <= 2000000)
        {
            $type = explode('/',$file[$name]['type'])[1];
            $doc = time().".$type";
            if (move_uploaded_file($file[$name]['tmp_name'],$place.$doc))
                return $doc;
            return false;
        }
        return false;
    }
}