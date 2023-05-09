<?php 
 

function view($name, $data = []) {
    extract($data);
    ob_start();
    require_once __DIR__."/src/views/". $name . '.php';
    $output = ob_get_clean();
    echo $output;
    
}