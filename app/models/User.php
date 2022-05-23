<?php


namespace app\models;


class User extends AppModel
{

    public $attributes = [
        'login' => '',
        'password' => '',
        'name' => '',
        'email' => '',
        'address' => '',
    ];

    protected $rules = [
        'required' => [
            ['login'],
            ['password'],
            ['confirmPassword'],
            ['name'],
            ['email'],
            ['address'],
        ],
        'email' => [
            ['email'],
        ],
        'lengthMin' => [
            ['password', 6],
        ],
        'equals' => [
            ['password', 'confirmPassword']
        ]
    ];

    public function checkUnique()
    {
        $user = \R::findOne('user', 'login=? OR email=?',
            [$this->attributes['login'], $this->attributes['email']]);
        if ($user) {
            if ($user->login == $this->attributes['login']) {
                $this->errors['unique'][] = 'This login is already used';
            }
            if ($user->email == $this->attributes['email']) {
                $this->errors['unique'][] = 'This email is already used';
            }
            return false;
        }
        return true;
    }

    public function login($isAdmin = false)
    {
        $login = !empty($_POST['login']) ? trim($_POST['login']) : null;
        $password = !empty($_POST['password']) ? trim($_POST['password']) : null;
        if ($isAdmin === true) {
            $user = \R::findOne('user', 'login = ? AND role = "admin"', [$login]);
        }else{
            $user = \R::findOne('user', 'login = ?', [$login]);
        }
        if (password_verify($password, $user->password)) {
            foreach ($user as $key=>$value) {
                if ($key != 'password') {
                    $_SESSION['user_info'][$key] = $value;
                }
            }
            return true;
        }
        return false;
    }

    public function isAuth()
    {
        $login = !empty($_POST['login']) ? trim($_POST['login']) : null;
        if (!\R::findOne('user', 'login = ?', [$login])) {
            return false;
        }
        return true;
    }

}