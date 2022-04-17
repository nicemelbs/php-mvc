<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;
use app\models\UserModel;

class AuthController extends Controller
{

    public function register(Request $request)
    {

        $this->setLayout('auth');
        $userModel = new UserModel();

        if ($request->isPost()) {
            $userModel->loadData($request->getBody());
            if ($userModel->validate() && $userModel->register()) {
                return 'Success';
            }
            echo '<pre>';
            var_dump($userModel);
            echo '</pre>';
            exit;

            return $this->render('register', [
                'model' => $userModel
            ]);
        }

        return $this->render('register', [
            'model' => $userModel
        ]);
    }


    public function login()

    {
        $this->setLayout('auth');
        return $this->render("login");
    }

}