<?php namespace App\Controllers;

class ColorController extends AbstractController {
    
    static public function new(){
        
        return 'new';
        
    }
    
    static public function create(){
        
        return 'create';
    }
    
    
    static public function show(){
        
        return 'show';
        
    }
    
    
    static public function edit(){
        
        return 'edit';
        
    }
    
    
    static public function update(){
        
        return 'update';
    }
    
    
    static public function delete(){
        
        return 'delete';
    }
    
    
    static public function index(){
        
        $service = new \App\Services\UserService();
        $vars = $service->paginate();
        
        return static::_view('color/index.twig', $vars);
        
    }
}