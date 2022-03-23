<?php


namespace app\models;


use mysql_xdevapi\Exception;

class Cart extends AppModel
{
    private static $title;
    private static $quantity;
    private static $price;
    private static $img;
    private static $alias;

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
        self::$alias = $product->alias;
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
        self::addInfoToTotalCart($product->price, $quantity);
    }

    private static function ifProductQuantityZero($product)
    {
        if ($_SESSION['cart'][$product->id]['quantity'] == 0) {
            unset($_SESSION['cart'][$product->id]);
        }
    }

    private static function addInfoToTotalCart($price, $quantity)
    {
        if (!isset($_SESSION['totalCart']['totalQuantity']) && !isset($_SESSION['totalCart']['totalAmount'])) {
            $_SESSION['totalCart']['totalQuantity'] = 0;
            $_SESSION['totalCart']['totalAmount'] = 0;
        }
        $_SESSION['totalCart']['totalQuantity'] += $quantity;
        $_SESSION['totalCart']['totalAmount'] += $quantity * $price;
    }

    private static function ifCartDoesntConsistProduct ($product)
    {
        if (self::$quantity > 0) {
            $_SESSION['cart'][$product->id] = [
                'title'      => self::$title,
                'quantity'   => self::$quantity,
                'price'      => self::$price,
                'img'        => self::$img,
                'alias'      => self::$alias,
            ];
        }
        self::addInfoToTotalCart(self::$price, self::$quantity);
    }

    private static function giveProductQuantity($product)
    {
        echo @$_SESSION['cart'][$product->id]['quantity'] ? $_SESSION['cart'][$product->id]['quantity'] : 0;
    }

}