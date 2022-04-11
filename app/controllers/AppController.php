<?php


namespace app\controllers;

use app\models\AppModel;
use pixie\App;
use pixie\Cache;

class AppController extends \pixie\base\Controller
{

    public function __construct($route)
    {
        parent::__construct($route);
        new AppModel();
        App::$app->setProperty('categories', self::cacheCategory());
    }

    public static function cacheCategory()
    {
        $cache = Cache::getInstance();
        $categories = $cache->get('categories');
        if (!$categories) {
            $categories = \R::getAssoc("SELECT * FROM category");
            $cache->set('categories', $categories);
        }
        return $categories;
    }

    protected function getSessionCart()
    {
        return $_SESSION['cart'];
    }

}