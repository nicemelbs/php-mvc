<?php

namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\exceptions\ItemNotFoundException;
use app\core\exceptions\NotFoundException;
use app\core\Request;
use app\core\Response;
use app\models\ContactForm;
use app\models\Post;
use app\models\User;

class SiteController extends Controller
{
    public function home()
    {
        return $this->render('home');
    }


    public function contact(Request $request, Response $response)
    {
        $contact = new ContactForm();
        if ($request->isPost()) {
            $contact->loadData($request->getBody());

            if ($contact->validate() && $contact->send()) {
                Application::$app->session->setFlash('success', 'Thank you. We\'ll get back to you shortly');
                return $response->redirect('/contact');
            }
        }
        return $this->render('contact', [
            'model' => $contact,
        ]);
    }

    public function profile(Request $request, Response $response)
    {
        $params = $request->getRouteParams();
        $user = User::findById($params['id']);
        return $this->render('profile', [
            'user' => $user
        ]);
    }

    /**
     * @throws NotFoundException
     */
    public function news(Request $request, Response $response)
    {
        $params = $request->getRouteParams();
        $post = Post::findById($params['id']);

        if (!$post) {
            throw new NotFoundException();
        }

        return $this->render('news', [
            'news' => $post
        ]);
    }
}