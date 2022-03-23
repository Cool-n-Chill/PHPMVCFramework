<?php


namespace app\controllers;

use app\models\AppModel;

class AppController extends \pixie\base\Controller
{

    public function __construct($route)
    {
        parent::__construct($route);
        new AppModel();
    }

    protected function getSessionCart()
    {
        return $_SESSION['cart'];
    }

}