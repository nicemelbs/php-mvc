<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;
use app\models\User;

class AuthController extends Controller
{

    public function register(Request $request)
    {

        $this->setLayout('auth');
        $userModel = new User();

        if ($request->isPost()) {
            $userModel->loadData($request->getBody());
            if ($userModel->validate() && $userModel->save()) {

                //display a session flash message after successful registration
                Application::$app->session
                    ->setFlash('success', 'Registration successful.');

                Application::$app->response->redirect('/');
            }

            return $this->render('register', [
                'model' => $userModel
            ]);
        }

        return $this->render('register', [
            'model' => $userModel
        ]);
    }


    public function login(Request $request, Response $response)
    {
        $loginForm = new LoginForm();
        if ($request->isPost()) {
            $loginForm->loadData($request->getBody());

            if ($loginForm->validate() && $loginForm->login()) {
                $response->redirect('/');
                return;
            }

        }


        return $this->render('login', [
            'model' => $loginForm
        ]);
    }

}