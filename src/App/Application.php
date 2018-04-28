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

        if (!array_key_exists($requestMethod, $this->_routes)) {
            echo 'not found';

            return;
        }
        $uri = $_SERVER['REQUEST_URI'];
        $routes = $this->_routes[$requestMethod];
        foreach ($routes as $route) {
            list($routeName, $handler) = $route;
            $preparedRoute = preg_quote($routeName, '/');
            if (preg_match("/^{$preparedRoute}$/i", $uri)) {
                echo $handler();

                return;
            }
        }

        echo 'not found';
    }

    /**
     * @param string $method
     * @param string $name
     * @param callable $handler
     */
    private function _addRoute(string $method, string $name, callable $handler)
    {
        $this->_routes[$method][] = [$name, $handler];
    }
}