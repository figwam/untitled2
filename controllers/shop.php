<?php

/**
 * Created by PhpStorm.
 * User: figwam
 * Date: 22.10.2017
 * Time: 16:35
 */
class shop
{
    /*
     * Регистрация покупки
     * $idUser - id покупателя
     * $idProduct - id покупки
     * $increment - количество покупок
     */
    static public function buy($idUser, $idProduct, $increment)
    {
        $assoc['idShop'] = $idProduct;
        $assoc['idUser'] = $idUser;
        $shop = model::searchString($assoc,'shop');
        if($shop)
        {
            $query = "UPDATE `".DB_NAME."`.`shop`
                      SET `numb` = ".($shop[0]['numb'] + $increment)."
                      WHERE `idShop` = $idProduct AND `idUser` = $idUser;";

        }
        else
        {
            $query = "INSERT INTO `".DB_NAME."`.`shop` (`idShop`, `idUser`, `numb`)
                      VALUES($idProduct,$idUser,$increment);";
        }
        model::insert($query);
    }
}