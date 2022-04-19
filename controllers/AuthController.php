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

            return $this->render('register', [
                'model' => $userModel
            ]);
        }

        return $this->render('register', [
            'model' => $userModel
        ]);
    }


    public function login(Request $request)

    {
        $this->setLayout('auth');
        $userModel = new UserModel();

        if ($request->isPost()) {
            $userModel->loadData($request->getBody());
            if ($userModel->validate()) {
                return 'Success';
            }

            return $this->render('login', [
                'model' => $userModel
            ]);
        }


        return $this->render('login', [
            'model' => $userModel
        ]);
    }

}