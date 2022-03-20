<?php


namespace pixie\base;

use pixie\Db;

abstract class Model
{

    public $attributes = [];
    public $errors = [];
    public $rules = [];

    public function __construct()
    {
        Db::getInstance();
    }

}