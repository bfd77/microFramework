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
    public function get($route, $handler)
    {
        $this->_routes['GET'][] = [$route, $handler];
    }

    /**
     * @param string $route
     * @param callable $handler
     */
    public function post($route, $handler)
    {
        $this->_routes['POST'][] = [$route, $handler];
    }

    public function run()
    {
        $requestMethod = $_SERVER['REQUEST_METHOD'];

        if (!array_key_exists($requestMethod, $this->_routes)) {
            echo $this->getNotFoundHandler();

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

        echo $this->getNotFoundHandler();
    }

    private function getNotFoundHandler()
    {
        return 'Not found';
    }
}