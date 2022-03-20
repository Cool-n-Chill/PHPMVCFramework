<?php


namespace app\controllers;

use pixie\Cache;

class MainController extends AppController
{

    public function indexAction()
    {
        $featuredProducts = $this->setFProducts();
        $productsInCart = $this->getSessionCart();
        self::setMeta('Main page');
        self::setData(compact('featuredProducts', 'productsInCart'));
    }

    private function setFProducts()
    {
        return \R::find('product', "hit = '1' AND quantity > '0'");
    }

    private function getSessionCart()
    {
        return $_SESSION['cart'];
    }

}