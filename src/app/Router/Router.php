<?php
namespace App\Router;

use App\Container\Container;
use App\Exceptions\RouteNotFoundException;

class Router
{

    private array $routes = [];

    function __construct(private Container $container)
    {

    }

    public function register(string $requesMmethod, string $route, callable | array $action): self
    {
        $this->routes[$requesMmethod][$route] = $action;
        return $this;
    }

    public function get(string $route, callable | array $action): self
    {
        $this->register('get', $route, $action);
        return $this;
    }

    public function post(string $route, callable | array $action): self
    {
        $this->register('post', $route, $action);
        return $this;
    }

    public function routes(): array
    {
        return $this->routes;
    }

    public function resolve(string $requestUri, $requesMmethod)
    {
        $route  = explode('?', $requestUri)[0];
        $action = $this->routes[$requesMmethod][$route] ?? null;

        if (! $action) {
            throw new RouteNotFoundException();
        }

        if (is_callable($action)) {
            return call_user_func($action);
        }

        if (is_array($action)) {
            [$class, $method] = $action;

            if (class_exists($class)) {

                $class = $this->container->get($class);

                if (method_exists($class, $method)) {
                    return call_user_func_array([$class, $method], []);
                }
            }

        }
        throw new RouteNotFoundException();
    }

    public function getContainer()
    {
        return $this->container;
    }
}
