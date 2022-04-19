<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\middleware\AuthMiddleware;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;
use app\models\User;

class AuthController extends Controller
{

    public function __construct()
    {
        //register middleware
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }

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
                Application::$app->session
                    ->setFlash('success', 'Welcome back, ' . Application::$app->user->getDisplayName() . '!');
                $response->redirect('/');
                return;
            }

        }


        return $this->render('login', [
            'model' => $loginForm
        ]);
    }

    public function logout(Request $request, Response $response)
    {
        Application::$app->session->destroy();
        Application::$app->session->setFlash('success', 'Logged out successfully.');
        $response->redirect('/');
    }

    public function profile(Request $request, Response $response)
    {
        return $this->render('profile');
    }

}