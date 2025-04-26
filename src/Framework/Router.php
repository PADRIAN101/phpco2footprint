<?php

declare(strict_types=1);

namespace Framework;

class Router
{
    #To store routes
    private array $routes = [];

    #To store middlewares
    private array $middlewares = [];

    #to render page 404
    private array $errorHandler;


    public function add(string $method, string $path, array $controller)
    {
        $path = $this->normalizePath($path);

        $regexPath = preg_replace('#{[^/]+}#', '([^/]+)', $path);

        $this->routes[] = [
            'path' => $path,
            'method' => strtoupper($method),
            'controller' => $controller,
            'middleware' => [],
            'regexPath' => $regexPath
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
        $method = strtoupper($_POST['_METHOD'] ?? $method);

        foreach ($this->routes as $route) {
            if (
                !preg_match("#^{$route['regexPath']}$#", $path, $paramValues) ||
                $route['method'] !== $method
            ) {
                continue;
            }

            array_shift($paramValues);

            preg_match_all('#{([^/]+)}#', $route['path'], $paramKeys);

            $paramKeys = $paramKeys[1];

            $params = array_combine($paramKeys, $paramValues);


            [$class, $function] = $route['controller'];

            $controllerInstance = $container ?
                $container->resolve($class) : new $class;

            #looping through middleware    
            $action = fn() => $controllerInstance->{$function}($params);

            $allMiddleware = [...$route['middleware'], ...$this->middlewares];

            foreach ($allMiddleware as $middleware) {
                $middlewareInstance = $container ? $container->resolve($middleware) : new $middleware;
                $action = fn() => $middlewareInstance->process($action);
            }

            $action();

            return;
        }

        $this->dispatchNotFound($container);
    }

    #Method to add new middleware
    public function addMiddleware(string $middleware)
    {
        $this->middlewares[] = $middleware;
    }

    public function addRouteMiddleware(string $middleware)
    {
        $lastRouteKey = array_key_last($this->routes);
        $this->routes[$lastRouteKey]['middleware'][] = $middleware;
    }


    public function setErrorHandler(array $controller)
    {
        $this->errorHandler = $controller;
    }


    public function dispatchNotFound(?Container $container)
    {
        [$class, $function] = $this->errorHandler;

        $controllerInstance = $container ? $container->resolve($class) : new $class;

        $action = fn() => $controllerInstance->$function();

        foreach ($this->middlewares as $middleware) {
            $middlewareInstance = $container ? $container->resolve($middleware) : new $middleware;
            $action = fn() => $middlewareInstance->process($action);
        }

        $action();
    }
}
