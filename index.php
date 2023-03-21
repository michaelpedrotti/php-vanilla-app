<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_WARNING);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require_once __DIR__ . '/vendor/autoload.php';


$resource = 'Home';
$action = null;
$id = 0;

if(preg_match_all('/([a-z]+)\/?([a-z0-9]+)?\/?([a-z]+)?/', $_SERVER['PATH_INFO'], $matches, PREG_SET_ORDER)){
    
    $matches = array_pop($matches);
          
    array_shift($matches); 
    $resource = ucfirst(array_shift($matches));
    
    if(count($matches) > 0){
       
        $piece = array_shift($matches);
        
        if(is_numeric($piece)){
            
            $id = $piece;
            
            if(count($matches) > 0){
                 
                $action = array_shift($matches);
            }
            else {
                
                $action = 'show';
            }
        }
        else {
            
            $action = $piece; 
        }
    }
    else {
        
        $action = 'index';
    }
}
else {
    
    $action = 'index';
}

$className = sprintf('\App\Controllers\%sController', $resource);

if(class_exists($className)){
    
    $controller = new $className();
    
    if(method_exists($controller, $action)){
        
        $args = ['id' => $id];
       
        
        print call_user_func_array([$controller, $action], $args); 
    }
    else {
        
       print "404 - action was not found";
    }
}
else {
    
    print "404 - resource was not found";
}