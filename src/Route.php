<?php
namespace Kadex;

class Route {

  static function get($route, $path_to_include)
  {
    if( $_SERVER['REQUEST_METHOD'] == 'GET' ){ Route::route($route, $path_to_include); }  
  }
  static function post($route, $path_to_include)
  {
    if( $_SERVER['REQUEST_METHOD'] == 'POST' ){ Route::route($route, $path_to_include); }    
  }
  static function put($route, $path_to_include)
  {
    if( $_SERVER['REQUEST_METHOD'] == 'PUT' ){ Route::route($route, $path_to_include); }    
  }
  static function patch($route, $path_to_include)
  {
    if( $_SERVER['REQUEST_METHOD'] == 'PATCH' )
      { Route::route($route, $path_to_include); }    
  }
  static function delete($route, $path_to_include)
  {
    if( $_SERVER['REQUEST_METHOD'] == 'DELETE' ){ Route::route($route, $path_to_include); }    
  }
  static function any($route, $path_to_include)
  { 
    Route::route($route, $path_to_include); 
  }
  static function route($route, $path_to_include){

    $callback = $path_to_include;
    if( !is_callable($callback) ){
      if(!strpos($path_to_include, '.php')){
        $path_to_include.='.php';
      }
    }
    $request_url = filter_var($_SERVER['REQUEST_URI'], FILTER_SANITIZE_URL);

    $request_url = rtrim($request_url, '/');
    $request_url = strtok($request_url, '?');
    $request_url = str_replace(APP_PATH,"",$request_url);
    
    $route_parts = explode('/', $route);
    $request_url_parts = explode('/', $request_url);
    array_shift($route_parts);
    array_shift($request_url_parts);
    if( $route_parts[0] == '' && count($request_url_parts) == 0 ){
      // Callback function
      if( is_callable($callback) ){
        call_user_func_array($callback, []);
        exit();
      }
      require_once __DIR__."/views/$path_to_include";
      exit();
    }  
    if( count($route_parts) != count($request_url_parts) ){ 
      require_once __DIR__."/views/404.php";
      exit(); 
    }  
      $parameters = [];
      for( $__i__ = 0; $__i__ < count($route_parts); $__i__++ ){
        $route_part = $route_parts[$__i__];
        if( preg_match("/^[$]/", $route_part) ){
          $route_part = ltrim($route_part, '$');
          array_push($parameters, $request_url_parts[$__i__]);
          $$route_part=$request_url_parts[$__i__];
        }
        else if( $route_parts[$__i__] != $request_url_parts[$__i__] ){
          require_once __DIR__."/views/404.php";
      exit();
        } 
    }  
    if(!file_exists( __DIR__."/views/$path_to_include")){
      $path_to_include = "404.php";
    }
    require_once __DIR__."/views/$path_to_include";
    exit();

  }

  public function out($text){
    echo htmlspecialchars($text);
  }
  public function set_csrf(){
    if( ! isset($_SESSION["csrf"]) ){ $_SESSION["csrf"] = bin2hex(random_bytes(50)); }
    echo '<input type="hidden" name="csrf" value="'.$_SESSION["csrf"].'">';
  }
  public function is_csrf_valid(){
    if( ! isset($_SESSION['csrf']) || ! isset($_POST['csrf'])){ return false; }
    if( $_SESSION['csrf'] != $_POST['csrf']){ return false; }
    return true;
  }
}