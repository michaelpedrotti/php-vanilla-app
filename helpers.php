<?php

if(!function_exists('array_has')){
    function array_has($arr, $key){

        return array_key_exists($key, $array) && (is_numeric($arr[$key]) || !empty($arr[$key]));
    }
}

if(!function_exists('array_get')){
    function array_get($arr, $key, $default = null){

        return array_has($arr, $key) ? $arr[$key] : $default;
    }
}

if(!function_exists('redirect')){
    function redirect($path){

        header("Location: " . $path);
        die();
    }
}


if(!function_exists('filter_body')){
    function filter_body($fields = []){

        $body = [];
        
        foreach($fields as $field){
            
            $body[$field] = $_POST[$field];
        }
        
        return $body;
    }
}

if(!function_exists('find_body')){
    function find_body($field = '', $default = null){
        return isset($_POST[$field]) ? $_POST[$field] : $default;
    }
}

