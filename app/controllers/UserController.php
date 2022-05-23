<?php


namespace app\controllers;


use app\models\User;

class UserController extends AppController
{

    public function signupAction()
    {
        if ($_SESSION['user_info']) redirect('http://pixie.loc/user/login');
        if(!empty($_POST)){
            $user = new User();
            $data = $_POST;
            $user->load($data);
            if (!$user->validate($data) || !$user->checkUnique()) {
                $user->getErrors();
                $_SESSION['form_data'] = $_POST;
            } else {
                $this->hashPassword($user);
                if ($user->save('user')) {
                    $_SESSION['success'] = 'You successfully signed up';
                    redirect('http://pixie.loc/user/login');
                } else {
                    $_SESSION['error'] = 'Error database! Try again later!';
                    redirect();
                }
            }
        }
        $this->setMeta('Sign up');
    }

    private function hashPassword($user) {
        $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
    }

    public function loginAction()
    {
        if(!empty($_POST)) {
            $user = new User();
            if (!$user->isAuth()) {
                $_SESSION['errors'] = 'Such login is not found';
            }
            if (!$user->login()) {
                $_SESSION['form_data'] = $_POST;
                $_SESSION['errors'] = 'Uncorrect password';
            }
            unset($_SESSION['form_data']);
            $_SESSION['success'] = 'You are successfully logged in';
        }
        redirect();
        $this->setMeta('Log in');
    }

    public function logoutAction()
    {
        if ($_SESSION['user_info']) unset($_SESSION['user_info']);
        redirect();
    }

}