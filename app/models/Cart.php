<?php


namespace app\models;


use mysql_xdevapi\Exception;

class Cart extends AppModel
{
    private static $title;
    private static $quantity;
    private static $price;
    private static $img;

    public static function addToCart($product, $quantity)
    {
        self::setVariables($product, $quantity);
        self::addProductInfoToSession($product, $quantity);
        self::giveProductQuantity($product);
    }

    private static function setVariables($product, $quantity)
    {
        self::$title = $product->title;
        self::$quantity = $quantity;
        self::$price = $product->price;
        self::$img = $product->img;
    }

    private static function addProductInfoToSession($product, $quantity)
    {
        if (array_key_exists($product->id, $_SESSION['cart'])) {
            self::ifCartAlreadyConsistProduct($product, $quantity);
        } else {
            self::ifCartDoesntConsistProduct($product);
        }

    }

    private static function ifCartAlreadyConsistProduct ($product, $quantity)
    {
        $_SESSION['cart'][$product->id]['quantity'] += $quantity;
        self::ifProductQuantityZero($product);
    }

    private static function ifProductQuantityZero($product)
    {
        if ($_SESSION['cart'][$product->id]['quantity'] == 0) {
            unset($_SESSION['cart'][$product->id]);
        }
    }

    private static function ifCartDoesntConsistProduct ($product)
    {
        if (self::$quantity > 0) {
            $_SESSION['cart'][$product->id] = [
                'title'      => self::$title,
                'quantity'   => self::$quantity,
                'price'      => self::$price,
                'img'        => self::$img,
            ];
        }
    }

    private static function giveProductQuantity($product)
    {
        echo @$_SESSION['cart'][$product->id]['quantity'] ? $_SESSION['cart'][$product->id]['quantity'] : 0;
    }

}