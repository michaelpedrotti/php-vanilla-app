<?php namespace App\Controllers;

abstract class AbstractController {
       
    static protected $tplEngine;
    
    /**
     * 
     * @return \Twig\Environment
     */
    static protected function _tplEngine(){
        
        
        if(empty(static::$tplEngine)){
            
            $loader = new \Twig\Loader\FilesystemLoader(__DIR__.'/../../resources/views/');
            static::$tplEngine = new \Twig\Environment($loader, []);
            
        }
        
        return static::$tplEngine;
    }
    
    /**
     * 
     * @return string
     */
    static protected function _view($viewpath = '', $vars = []){
        
        
        return static::_tplEngine()->render($viewpath, $vars);
    }
}