<?php namespace App\Controllers;

class UserController extends AbstractController {
       
    static public function new(){
        
        return static::_view('user/new.twig');
        
    }
    
    static public function create(){
        
        try {
           
            $service = new \App\Services\UserService();
            $service->create(filter_body(['email', 'name']));
            
            redirect('/user');
        }
        catch (\Exception $e) {
            
            print $e->getMessage();
            print $e->getTraceAsString();
            
            static::$flash[] = ['message' => $e->getMessage(), 'level' => 'danger'];
            
            return static::new();
        }
    }
    
    
    static public function show($id = 0){
        
        $service = new \App\Services\UserService();
        $data = $service->find($id);
        
        if(empty($data)){
            
            // Flash messag
            redirect('/user');
        }
        
        
        return static::_view('user/show.twig', ['data' => $data]);
        
    }
    
    
    static public function edit($id = 0){
        
        $service = new \App\Services\UserService();
        $data = $service->find($id);
        
        if(empty($data)){
            
            // Flash messag
            redirect('/user');
        }
        
        
        return static::_view('user/edit.twig', ['data' => $data]);
        
    }
    
    
    static public function update($id = 0){
        
        try {
           
            $service = new \App\Services\UserService();
            $service->update(filter_body(['email', 'name']), $id);
            
            redirect('/user');
        }
        catch (\Exception $e) {
            
            print $e->getMessage();
            print $e->getTraceAsString();
            
            static::$flash[] = ['message' => $e->getMessage(), 'level' => 'danger'];
            
            return static::new();
        }
    }
    
    
    static public function delete(){
        
        return 'delete';
    }
    
    
    static public function index(){
        
        $service = new \App\Services\UserService();
        $vars = $service->paginate();
        
        return static::_view('user/index.twig', $vars);
        
    }
}