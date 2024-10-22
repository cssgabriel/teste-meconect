<?php

namespace Project\Meconect\Route;

use DomainException;
use Project\Meconect\Structure\Connection\ConnectionCreator;

class Route
{
  private string $path;
  private string $method;
  private array $routes = [];

  public function __construct() {}

  public function get(string $path, array $routeData)
  {
    return $this->updateRoutes([
      "method" => "GET",
      "path" => $path,
      "controller" => $routeData[0],
      "action" => $routeData[1],
    ]);
  }

  public function post(string $path, array $routeData)
  {
    return $this->updateRoutes([
      "method" => "POST",
      "path" => $path,
      "controller" => $routeData[0],
      "action" => $routeData[1],
    ]);
  }

  private function updateRoutes(array $routeInfo)
  {
    extract($routeInfo);

    $this->routes = [
      ...$this->routes,
      "{$method}|{$path}" => [
        'controller' => $controller,
        'action' => $action,
      ]
    ];
    return $this;
  }

  public function watch()
  {
    $this->path = $_SERVER['PATH_INFO'] ?? "/";
    $this->method = $_SERVER['REQUEST_METHOD'];

    $this->resolvePath();
  }

  public function middleware(string|array $middleware)
  {
    $lastAddedRoute = array_key_last($this->routes);
    $this->routes[$lastAddedRoute]['middlewares'] = is_array($middleware) ? $middleware : [$middleware];
    return $this;
  }

  private function resolvePath()
  {
    $routeData = $this->routes[$this->method . "|" . $this->path] ?? null;
    if (!$routeData) $this->pageNotFound();

    [
      'controller' => $controller,
      'action' => $action,
    ] = $routeData;

    if (!$controller) throw new DomainException("Controller não definido na rota " . $this->method . "|" . $this->path);

    /** @var Controller $controller */
    $controller = new $controller();
    $pdo = ConnectionCreator::connect();

    $middlewares = null;
    if (array_key_exists('middlewares', $routeData)) ['middlewares' => $middlewares] = $routeData;
    
    if ($middlewares) {
      foreach ($middlewares as $middleware) {
        $middleware = new $middleware();
        $middleware->run();
      }
    }
    
    return $controller->$action($pdo);
  }

  private function pageNotFound()
  {
    http_response_code(404);
    $template = new \League\Plates\Engine(__DIR__ . "/../../views");
    echo $template->render('page-not-found');
    exit;
  }
}
