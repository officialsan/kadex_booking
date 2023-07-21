<?php 

function view($name, $data = []) {
    extract($data);
    ob_start();
    require_once __DIR__."/src/views/". $name . '.php';
    $output = ob_get_clean();
    echo $output;
    
}
function render($name, $data = []) {
    extract($data);
    ob_start();
    require_once __DIR__."/src/views/". $name . '.php';
    $output = ob_get_clean();
    return $output;
}

function redirect(string $url = "")
{
    if($url == "") header('Location: ' . $_SERVER['HTTP_REFERER']);
    else header('Location: ' . APP_URL.$url);
}