<?php

namespace app\core;

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
            $this->response->setStatusCode(404);
            return 'HTTP 404';

        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        return call_user_func($callback);
    }

    protected function renderView($view)
    {
        $layoutContent = $this->layoutContent();
        $viewContent = $this->renderOnlyView($view);

        return str_replace('{{ content }}', $viewContent, $layoutContent);
    }

    protected function layoutContent()
    {
        //output buffering way to store output to variables
        ob_start();
        include_once Application::$ROOT_DIR . "/views/layouts/main.php";

        //ob_get_clean - returns the value of the
        //current output buffer and cleans the buffer
        return ob_get_clean();
    }

    protected function renderOnlyView($view)
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/views/$view.php";
        return ob_get_clean();
    }
}