<?php 

namespace App;

class Router
{
    protected $routes = [];

    /**
     * Registers a GET route.
     *
     * @param $path
     * @param $callback
     */
    public function get($path, $callback)
    {
        $this->routes[] = [
            'url' => $path,
            'callback' => $callback,
            'method' => 'GET',
        ];
    }

    /**
     * Handles incoming request.
     *
     * @return mixed
     */
    public function run()
    {
        $reqUrl = $_SERVER['PATH_INFO'];
        $reqMet = $_SERVER['REQUEST_METHOD'];

        foreach ($this->routes as $route) {
            $pattern = "@^" . preg_replace('/\\\:[a-zA-Z0-9\_\-]+/', '([a-zA-Z0-9\-\_]+)', preg_quote($route['url'])) . "$@D";
            $matches = [];
            
            if ($reqMet == $route['method'] && preg_match($pattern, $reqUrl, $matches)) {
                array_shift($matches);
                return call_user_func_array($route['callback'], $matches);
            }
        }
    }
}
