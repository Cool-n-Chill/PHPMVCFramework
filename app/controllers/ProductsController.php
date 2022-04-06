<?php


namespace app\controllers;


class ProductsController extends AppController
{

    public function viewAction()
    {
        $this->setMeta('Products page');
        $this->setData($this->setVariables());
    }

    private function setVariables()
    {
        $products = $this->findAllProducts();
        return compact('products');
    }

    private function findAllProducts()
    {
        return \R::find('product', "status = '1'");
    }

}