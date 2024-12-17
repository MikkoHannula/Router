<?php

namespace App;

class Router
{

  private array $routes = [];

  public function get(string $path, $callback, $middleware = null)
  {
    $this->addRoute('GET', $path, $callback, $middleware);
  }

  public function post(string $path, $callback, $middleware = null)
  {
    $this->addRoute('POST', $path, $callback, $middleware);
  }

  private function addRoute(string $method, string $path, $callback, $middleware)
  {

    $param = false;

    if (preg_match("/\/{.*}$/", $path)) {
      $param = true;
    }

    $this->routes[] = [
      'path' => $path,
      'method' => strtoupper($method),
      'param' => $param,
      'controller' => $callback,
      'middleware' => $middleware
    ];
  }

  public function run()
  {

    // echo '<pre>';
    // var_dump($this->routes);
    // echo '</pre>';
    // exit;

    // /customer/1234

    session_start();

    $uri = parse_url($_SERVER['REQUEST_URI']);
    $path = $uri['path'];
    $method = $_SERVER['REQUEST_METHOD'];
    $isParam = false;
    $uriParam = [];
    $params = null;

    if (preg_match("/\/[0-9]+$/", $path)) {
      $isParam = true;
      preg_match_all("/[0-9]+$/", $path, $uriParam);
    }

    foreach ($this->routes as $route) {
      if (
        $route['method'] === $method &&
        preg_replace("/{.*}/", '', $route['path']) ===
        preg_replace("/[0-9]/", '', $path)
      ) {
        // preg_match("#^{$route['path']}$#", $path)){

        if ($isParam) {
          // /customer/{id}
          // /customer/345
          // $params = array('id' => 345)
          preg_match_all("/(?<={).+?(?=})/", $route['path'], $matches);
          $params = array($matches[0][0] => $uriParam[0][0]);
        }

        $controller = $route['controller'];
        $middleware = $route['middleware'];

        if ($middleware) {

          call_user_func($middleware, function () use ($controller) {
            $this->executeController($controller);
          });
        } else {
          $this->executeController($controller);
        }
        
      }
    }
  }

  private function executeController($controller, $params = null)
  {

    if (is_array($controller)) {
      [$class, $function] = $controller;
      $controllerInstance = new $class;
      $controllerInstance->{$function}($params);
    } else {
      call_user_func($controller);
    }
  }
}
