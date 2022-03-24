<?php


namespace app\controllers;


use app\models\Cart;

class CartController extends AppController
{
    private $id;
    private $quantity;
    private $product;
    private $url;

    public function viewAction()
    {
        self::setMeta('Shopping Cart');
        self::setData($this->setVariablesForView());
    }

    public function addAction()
    {
        $this->setVariables();
        Cart::addToCart($this->product, $this->quantity);
        $this->makeResponse($this->product, $this->url);
        die;
    }

    public function clearAction()
    {
        $_SESSION['cart'] = array();
        $_SESSION['totalCart'] = array();
        echo '<p>Your shopping cart is empty</p>';
        die;
    }

    private function setVariables()
    {
        $this->id = $this->setValueOfVariable('id');
        $this->quantity = $this->setValueOfVariable('quantity');
        $this->url = $this->setValueOfVariable('url');
        $this->product = $this->findProductInDB($this->id);
    }

    private function makeResponse($product, $url)
    {
        echo json_encode([
            'quantity'  => $this->makeQuantityResponse($product),
            'html'      => $this->makeHTMLResponse($this->findControllerInUrl($url), $this->makeQuantityResponse($product)),
            'totalCart' => $this->makeTotalCartResponse(),
        ]);
    }

    private function makeQuantityResponse($product)
    {
        return isset($_SESSION['cart'][$product->id]['quantity']) ? $_SESSION['cart'][$product->id]['quantity'] : 0;
    }

    private function makeHTMLResponse($controller, $quantity)
    {
        if ($controller == '' && $quantity == 0){
            return $this->createHTMLChunk('button');
        }
        if ($controller == '' && $quantity == 1){
            return $this->createHTMLChunk('counter');
        }
        if ($controller == 'product' && $quantity == 0){
             return $this->createHTMLChunk('form');
        }
        if ($controller == 'product' && $quantity > 0){
            return $this->createHTMLChunk('counter');
        }
        if ($controller == 'cart' && $quantity == 1){
            return $this->createHTMLChunk('counter');
        }
        return '';
    }

    private function createHTMLChunk($chunkName)
    {
        $product = $this->product;
        ob_start();
        require_once APP . "/views/Cart/" . $chunkName . ".php";
        return ob_get_clean();
    }

    private function findControllerInUrl($url)
    {
        return isset(explode('/', $url)[3]) ? explode('/', $url)[3] : '';
    }

    private function makeTotalCartResponse()
    {
        return $_SESSION['totalCart'];
    }

    private function setVariablesForView()
    {
        $products = $_SESSION['cart'];
        return compact('products');
    }


    private function setValueOfVariable($indexName)
    {
        return !empty($_GET["$indexName"]) ? $_GET["$indexName"] : null;
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

}