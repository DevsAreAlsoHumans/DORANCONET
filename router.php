<?php

namespace App;

class Router
{
  private static $routes = [];

  public static function addRoute($method, $path, $callback)
  {
    self::$routes[] = ['method' => $method, 'path' => $path, 'callback' => $callback];
  }

  public static function dispatch($method, $path)
  {
    foreach (self::$routes as $route) {
      $routePattern = self::convertPathToRegex($route['path']);

      if ($route['method'] === $method && preg_match($routePattern, $path, $matches)) {
        array_shift($matches);

        call_user_func_array($route['callback'], array_values($matches));
        return;
      }
    }

    echo "404 - Not Found";
  }

  private static function convertPathToRegex($path)
  {
    $path = preg_replace('/\{([a-zA-Z0-9_]+)\}/', '(?P<$1>[a-zA-Z0-9_-]+)', $path);

    $path = "~^$path$~";

    return $path;
  }
}
