<?php


namespace app\controllers;


use app\models\Breadcrumbs;
use app\models\Category;
use app\Traits\TPaginationController;
use pixie\Pagination;

class CategoryController extends AppController
{

    use TPaginationController;

    private $alias;
    private $totalProductInCategory;

    public function viewAction()
    {
        $this->setVariables();
        $this->setMeta();
        $this->setData($this->setViewVariables());
    }

    public function setVariables()
    {
        $this->alias = $this->route['alias'];
    }

    private function setViewVariables()
    {
        $category = new Category($this->alias);
        $productsQuantity = $category->getCategoryProductsQuantity();
        $breadcrumbs = Breadcrumbs::getBreadcrumbs($category->getCategory()->id);
        $pagination = new Pagination($this->getCurrentPageNumber(), $productsQuantity);
        $products = $category->getCategoryProductsPerPage($pagination->getStartAndPerPage());
        $currentPageNumber = $pagination->getCurrentPageNumber();
        $paginationView = $this->getPaginationView($pagination->getLinks(), $currentPageNumber);
        return compact('products', 'breadcrumbs', 'paginationView');
    }

}