<?php

namespace app\controllers;

use app\core\Request;

class AuthController extends Controller
{

    public function register(Request $request)
    {
        $this->setLayout('auth');

        if ($request->isPost()) {
            return "Handle data";
        }

        return $this->render("register");
    }


    public function login()

    {
        $this->setLayout('auth');
        return $this->render("login");
    }

}