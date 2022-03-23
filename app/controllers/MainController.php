<?php


namespace app\controllers;

use pixie\Cache;

class MainController extends AppController
{

    public function indexAction()
    {
        self::setMeta('Main page');
        self::setData($this->setVariables());
    }

    private function setFProducts()
    {
        return \R::find('product', "hit = '1' AND quantity > '0'");
    }

    private function setVariables()
    {
        $featuredProducts = $this->setFProducts();
        $productsInCart = $this->getSessionCart();
        return compact('featuredProducts', 'productsInCart');
    }

}