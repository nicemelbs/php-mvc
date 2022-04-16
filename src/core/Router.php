<?php

namespace app\core;

class Router
{
    protected array $routes = [];
    public Request $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
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
            return 'HTTP 404';
        }

        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        return call_user_func($callback);
    }

    private function renderView($view)
    {

        ob_start();
        include_once Application::$ROOT_DIR . "/src/views/$view.php";
        $content = ob_get_contents();
        ob_clean();

        return $this->layoutContent($content);
    }

    protected function layoutContent($content)
    {
        ob_start();
        include_once Application::$ROOT_DIR . "/src/views/layouts/main.php";

        $layout = ob_get_contents();
        $page = str_replace('{{ content }}', $content, $layout);
        ob_clean();
        return $page;
    }
}