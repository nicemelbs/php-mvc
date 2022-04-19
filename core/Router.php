<?php

namespace app\core;

use app\core\exceptions\NotFoundException;

class Router
{
    protected array $routes = [];
    public Request $request;
    public Response $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    public function get(string $path, $callback)
    {
        $this->routes['get'][$path] = $callback;

    }

    public function resolve()
    {
        //determine the URL path and method
        $path = $this->request->getPath();
        $method = $this->request->getMethod();
        $callback = $this->routes[$method][$path] ?? false;

        if ($callback === false) {
            throw new NotFoundException();
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
            /**
             * @var Controller $controller
             */
            $controller = new $callback[0]();
            Application::$app->controller = $controller;
            $controller->action = $callback[1];
            $callback[0] = $controller;

            foreach ($controller->getMiddlewares() as $middleware) {
                $middleware->execute();
            }

        }

        return call_user_func($callback, $this->request, $this->response);
    }

    public function renderView($view, $params = [])
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view, $params);

        return str_replace('{{ content }}', $viewContent, $layoutContent);
    }

    protected function renderContent($viewContent)
    {
        $layoutContent = $this->layoutContent();
        return str_replace('{{ content }}', $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        if (isset(Application::$app->controller)) {
            $layout = Application::$app->controller->layout;
        } else
            $layout = Application::$app->getLayout();
        //output buffering way to store output to variables
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/$layout.php";

        //ob_get_clean - returns the value of the
        //current output buffer and cleans the buffer
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params = [])
    {

        foreach ($params as $key => $value) {
            //$$ operator creates a variable with the name equal to the value of $key.
            //in this case, if I have ['alice' => 'umbrella']
            //it will create a new variable $alice
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }

    public function post($path, $callback)
    {
        $this->routes['post'][$path] = $callback;
    }
}