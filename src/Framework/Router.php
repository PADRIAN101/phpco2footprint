<?php

declare(strict_types=1);

namespace Framework;

class Router
{
    #To store routes
    private array $routes = [];

    #To store middlewares
    private array $middlewares = [];


    public function add(string $method, string $path, array $controller)
    {
        $path = $this->normalizePath($path);
        $this->routes[] = [
            'path' => $path,
            'method' => strtoupper($method),
            'controller' => $controller
        ];
    }

    private function normalizePath(string $path): string
    {
        $path = trim($path, '/');
        $path = "/{$path}/";
        $path = preg_replace('#[/]{2,}#', '/', $path);

        return $path;
    }

    public function dispatch(string $path, string $method, Container $container = null)
    {
        $path = $this->normalizePath($path);
        $method = strtoupper($method);

        foreach ($this->routes as $route) {
            if (
                !preg_match("#^{$route['path']}$#", $path) ||
                $route['method'] !== $method
            ) {
                continue;
            }

            [$class, $function] = $route['controller'];

            $controllerInstance = $container ?
                $container->resolve($class) : new $class;

            #looping through middleware    
            $action = fn() => $controllerInstance->{$function}();

            foreach ($this->middlewares as $middleware) {
                $middlewareInstance = $container ? $container->resolve($middleware) : new $middleware;
                $action = fn() => $middlewareInstance->process($action);
            }

            $action();

            return;
        }
    }

    #Method to add new middleware
    public function addMiddleware(string $middleware)
    {
        $this->middlewares[] = $middleware;
    }
}
