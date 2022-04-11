<?php


namespace app\widgets\menu;


use pixie\App;
use pixie\Cache;

class Menu
{

    private $data;
    private $tree;
    private $menuHtml;
    private $tpl;
    private $container = 'ul';
    private $class = 'menu';
    private $dbTable = 'category';
    private $cache = 0;
    private $cacheKey = 'pixie_menu';
    private $attrs = [];
    private $prepend = '';

    public function __construct($options = [])
    {
        $this->tpl = __DIR__ . '/menu_tpl/menu.php';
        $this->getOptions($options);
        $this->run();
    }

    private function getOptions($options)
    {
        foreach ($options as $key => $value) {
            if (property_exists($this, $key)) {
                $this->$key = $value;
            }
        }
    }

    private function run()
    {
        $cache = Cache::getInstance();
        $this->menuHtml = $cache->get($this->cacheKey);
        if (!$this->menuHtml) {
            $this->data = App::$app->getProperty('categories');
            $this->tree = $this->getTree();
            $this->menuHtml = $this->getMenuHtml($this->tree);
            if ($this -> cache) {
                $cache->set($this->cacheKey, $this->menuHtml, $this->cache);
            }
        }
        $this->menuOutput();
    }

    private function menuOutput()
    {
        echo "<{$this->container} class='{$this->class}' {$this->getAttrsFromArray()}>";
            echo $this->menuHtml;
        echo "</{$this->container}>";
    }

    private function getAttrsFromArray()
    {
        $attrs = '';
        foreach ($this->attrs as $k => $v) {
            $attrs .= " $k='$v' ";
        }
        return $attrs;
    }

    private function getTree()
    {
        $tree = [];
        $data = $this->data;
        foreach ($data as $id => &$node) {
            if (!$node['parent_id']) {
                $tree[$id] = &$node;
            } else {
                $data[$node['parent_id']]['childs'][$id] = &$node;
            }
        }
        return $tree;
    }

    private function getMenuHtml($tree, $tab = '')
    {
        $str = '';
        foreach ($tree as $id => $category) {
            $str .= $this->categoriesToTemplate($category, $tab, $id);
        }
        return $str;
    }

    private function categoriesToTemplate($category, $tab, $id)
    {
        ob_start();
        require $this->tpl;
        return ob_get_clean();
    }

}