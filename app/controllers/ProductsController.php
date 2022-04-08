<?php


namespace app\controllers;


use app\Traits\TPaginationController;
use pixie\Pagination;

class ProductsController extends AppController
{

    use TPaginationController;

    public function viewAction()
    {
        $this->setMeta('Products page');
        $this->setData($this->setVariables());
    }

    private function setVariables()
    {
        $productsQuantity = $this->getQuantityProduct();
        $pagination = new Pagination($this->getCurrentPageNumber(), $productsQuantity);
        $products = $this->findProductsPerPage($pagination->getStartAndPerPage());
        $currentPageNumber = $pagination->getCurrentPageNumber();
        $paginationView = $this->getPaginationView($pagination->getLinks(), $currentPageNumber);
        return compact('products', 'paginationView');
    }

    private function findProductsPerPage($startAndPerPage)
    {
        extract($startAndPerPage);
        return \R::find('product', "status = '1' LIMIT $start, $perPage");
    }

    private function getQuantityProduct()
    {
        return \R::count('product', "status = '1'");
    }

}