<?php

namespace App;

class Application implements ApplicationInterface
{

    /**
     * @var array
     */
    private $_routes = [];

    /**
     * @param string $route
     * @param callable $handler
     */
    public function get(string $route, callable $handler)
    {
        $this->_addRoute('GET', $route, $handler);
    }

    /**
     * @param string $route
     * @param callable $handler
     */
    public function post(string $route, callable $handler)
    {
        $this->_addRoute('POST', $route, $handler);
    }

    public function run()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];
        $requestData   = $_GET;

        if (!array_key_exists($requestMethod, $this->_routes)) {
            echo 'not found';

            return;
        }
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $routes = $this->_routes[$requestMethod];
        foreach ($routes as $route) {
            list($routeName, $handler) = $route;
            $matches = [];
            $preparedRoute = str_replace('/', '\/', $routeName);
            if (preg_match("/^{$preparedRoute}$/i", $uri, $matches)) {
                $matchesWithKeys = array_filter($matches, function ($match) {
                    return !is_numeric($match);
                }, ARRAY_FILTER_USE_KEY);
                echo json_encode($handler($requestData, $matchesWithKeys));

                return;
            }
        }

        echo 'not found';
    }

    /**
     * @param string $method
     * @param string $route
     * @param callable $handler
     */
    private function _addRoute(string $method, string $route, callable $handler)
    {
        $dynamicRoute = preg_replace('/:[^\/]+/', '(?P<$0>[\w]+)', $route);
        $dynamicRoute = str_replace(':', '', $dynamicRoute);
        $this->_routes[$method][] = [$dynamicRoute, $handler];
    }
}