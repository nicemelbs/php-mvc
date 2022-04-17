<?php

namespace app\controllers;

use app\core\Application;

class Controller
{
    protected $layout = 'main';

    //GET: /users
    //route: users.index
    public function index()
    {

    }

    //GET: /users/create
    //route: users.create
    public function create()
    {

    }

    //POST: /users
    //route: users.store
    public function store()
    {

    }

    //GET: /users/{userId}
    //route: users.show
    public function show()
    {

    }

    //PUT/PATCH: /users/{userId}
    //route: users.update
    public function update()
    {

    }

    //DELETE: /users/{userId}
    //route: users.destroy
    public function destroy()
    {

    }

    public function render($view, $params = [])
    {
        return Application::$app->router->renderView($view, $params);
    }

    /**
     * @return string
     */
    public function getLayout(): string
    {
        return $this->layout;
    }

    /**
     * @param string $layout
     */
    public function setLayout(string $layout): void
    {
        $this->layout = $layout;
    }
}