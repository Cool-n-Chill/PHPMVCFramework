<?php


namespace app\controllers;

use app\models\Breadcrumbs;

class ProductController extends AppController
{
    private $alias;
    private $product;

    public function viewAction()
    {
        $this->setAlias();
        $this->setProduct();
        $this->checkIfProductInDB($this->product);
        $this->setMeta($this->product->title, $this->product->description, $this->product->keywords);
        $this->setData($this->setVariables());
    }

    private function setAlias()
    {
        $this->alias = $this->route['alias'];
    }

    private function setProduct()
    {
        $this->product = \R::findOne('product', "alias = ? AND quantity > '0'", [$this->alias]);
    }

    private function checkIfProductInDB($product)
    {
        if(!$product){
            throw new \Exception('Page not found', 404);
        }
    }

    private function setVariables()
    {
        $product = $this->product;
        $categorys = $this->getCategoryNames();
        $related_products = $this->getRelatedProducts();
        $breadcrumbs = Breadcrumbs::getBreadcrumbs($product->category_id, $product->title);
        $gallery = $this->getProductImages();
        return compact('product', 'categorys', 'related_products','breadcrumbs', 'gallery');
    }

    private function getCategoryNames()
    {
        return \R::getAll('SELECT ag.title
                                FROM attribute_group ag JOIN attribute_product ap 
                                ON ag.id = ap.attribute_id
                                WHERE ap.product_id = ?',
                                [$this->product->id]
                            );
    }


    private function getRelatedProducts()
    {
        return \R::getAll('SELECT *
                                FROM product JOIN related_product 
                                ON product.id = related_product.related_id 
                                WHERE related_product.product_id = ?',
                                [$this->product->id]
                            );
    }

    private function getProductImages()
    {
        return \R::getAll('SELECT g.image 
                                FROM gallery g 
                                WHERE g.product_id = ?',
                                [$this->product->id]
                            );
    }



}