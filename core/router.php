<?php

class Router
{
    private static array $routes = [
        'GET' => [],
        'POST' => [],
    ];

    public static function get(string $uri, callable|array $action)
    {
        self::$routes['GET'][trim($uri, '/')] = $action;
    }

    public static function post(string $uri, callable|array $action)
    {
        self::$routes['POST'][trim($uri, '/')] = $action;
    }

    public static function dispatch(PDO $pdo)
    {
        $method = $_SERVER['REQUEST_METHOD'];
        $uri = trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');

        $action = self::$routes[$method][$uri] ?? null;

        if (!$action) {
            http_response_code(404);
            echo "404 - Page Not Found";
            exit;
        }

        if (is_array($action)) {
            [$controllerClass, $methodName] = $action;
            $controller = new $controllerClass($pdo);
            return $controller->$methodName($_POST);
        }


        return $action();
    }
}
