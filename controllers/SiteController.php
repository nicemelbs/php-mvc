<?php

namespace app\controllers;

use app\core\Controller;
use app\core\Request;

class SiteController extends Controller
{
    public function handleContact(Request $request)
    {
        $body = $request->getBody();
    }

    public function home()
    {
        $params = [
            'name' => 'melbs'
        ];

        return $this->render('home', $params);
    }


    public function contact()
    {
        $params = [
            'name' => 'melbs'
        ];

        return $this->render('contact', $params);

    }
}