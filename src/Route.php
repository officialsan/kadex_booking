<?php
namespace Kadex;
use Kadex\controllers\HomeController;
class Route {
  private $routes = [];

  public function get($path, $callback) {
    $this->routes['GET'][$path] = $callback;
  }

  public function post($path, $callback) {
    $this->routes['POST'][$path] = $callback;
  }

  public function run() {
    $method = $_SERVER['REQUEST_METHOD'];
    $request_url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);
    $uri = str_replace(APP_PATH,"",$request_url);
    $path = parse_url($uri, PHP_URL_PATH);
    $params = [];

    foreach ($this->routes[$method] as $route => $callback) {
      $pattern = preg_replace('/:[^\/]+/', '([^/]+)', $route);
      $pattern = str_replace('/', '\/', $pattern);
      
      if (preg_match('/^' . $pattern . '$/', $path, $matches)) {
        array_shift($matches);

        if (strpos($route, ':') !== false) {
          preg_match_all('/:([^\/]+)/', $route, $keys);
          $keys = $keys[1];

          foreach ($keys as $i => $key) {
            $params[$key] = $matches[$i];
          }
        }
        // if(!is_callable($callback )){
        //   $callback =  "Kadex\controllers\\".$callback();
          
        // }
        $response = call_user_func_array($callback, [$params]);
        

        if ($response) {
          echo $response;
        }

        return;
      }
    }

    http_response_code(404);
    echo view('404');
  }
  
}


