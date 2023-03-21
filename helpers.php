<?php

if(!function_exists('array_get')){
    function array_get($arr, $key, $default = null){

        return array_key_exists($key, $array) && (is_numeric($arr[$key]) || !empty($arr[$key])) ? $arr[$key] : $default;
    }
}