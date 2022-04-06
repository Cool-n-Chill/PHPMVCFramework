<?php


namespace pixie\base;


abstract class Controller
{

    protected $route;
    protected $controller;
    protected $view;
    protected $model;
    protected $prefix;
    protected $layout;
    protected $data = [];
    protected $meta = ['title' => '', 'desc' => '', 'keywords' => ''];

    protected function __construct($route)
    {
        $this->route = $route;
        $this->controller = $route['controller'];
        $this->model = $route['controller'];
        $this->view = $route['action'];
        $this->prefix = $route['prefix'];
    }

    public function getView()
    {
        $viewObject = new View($this->route, $this->layout, $this->view, $this->meta);
        $viewObject->render($this->data);
    }

    protected function setData($data)
    {
        $this->data = $data;
    }

    protected function setMeta($title = '', $desc = '', $keywords = '')
    {
        $this->meta['title'] = $title;
        $this->meta['desc'] = $desc;
        $this->meta['keywords'] = $keywords;
    }

    protected function isAjax ()
    {
        return isset($_SERVER['HTTP_X_REQUESTED_WITH']) && $_SERVER['HTTP_X_REQUESTED_WITH'] === 'XMLHttpRequest';
    }

    protected function loadView($view)
    {
        require_once APP . "/views/{$this->prefix}{$this->controller}/{$view}.php";
    }

}