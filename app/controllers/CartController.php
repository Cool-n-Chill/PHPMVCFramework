<?php


namespace app\controllers;


use app\models\Cart;

class CartController extends AppController
{
    private $id;
    private $quantity;
    private $product;

    public function addAction()
    {
        $this->setVariables();
        Cart::addToCart($this->product, $this->quantity);
        die;
    }

    public function counterAction()
    {
        $this->setVariables();
        $this->createButton();
        die;
    }

    public function buttonAction()
    {
        $this->setVariables();
        $this->createCounter();
        die;
    }

    private function setVariables()
    {
        $this->id = $this->setValueOfVariable('id');
        $this->quantity = $this->setValueOfVariable('quantity');
        $this->product = $this->findProductInDB($this->id);
    }


    private function setValueOfVariable($indexName)
    {
        return !empty($_GET["$indexName"]) ? (int)$_GET["$indexName"] : null;
    }

    private function findProductInDB ($id)
    {
        if ($id){
            return \R::findOne('product', 'id = ?', [$id]);
        }
    }

    private function respondToAjaxOrNot ()
    {
        if ($this->isAjax()) {
            $this->loadView('cart');
        }
    }

    private function createCounter()
    {
        $product = $this->product;
        require_once APP . "/views/Cart/counter.php";
    }

    private function createButton()
    {
        $product = $this->product;
        require_once APP . "/views/Cart/button.php";
    }
}