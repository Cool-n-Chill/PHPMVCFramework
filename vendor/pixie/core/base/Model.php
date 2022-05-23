<?php


namespace pixie\base;

use pixie\Db;
use Valitron\Validator;

abstract class Model
{

    protected $attributes = [];
    protected $errors = [];
    protected $rules = [];

    public function __construct()
    {
        Db::getInstance();
    }

    public function load($data)
    {
        foreach ($this->attributes as $name => $value){
            if (isset($data[$name])) {
                $this->attributes[$name] = $data[$name];
            }
        }
    }

    public function save($table)
    {
        $userInDB = \R::dispense($table);
        foreach ($this->attributes as $name => $value) {
            $userInDB->$name = $value;
        }
        return \R::store($userInDB);
    }

    public function validate($data)
    {
        $validator = new Validator($data);
        $validator->rules($this->rules);
        if ($validator->validate()) {
            return true;
        } else {
            $this->errors = $validator->errors();
            return false;
        }
    }

    public function getErrors()
    {
        $errors = '<ul>';
        foreach ($this->errors as $error) {
            foreach ($error as $item) {
                $errors .= "<li>$item</li>";
            }
        }
        $errors .= '</ul>';
        $_SESSION['errors'] = $errors;
    }

}