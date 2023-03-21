<?php namespace App\Controllers;

class ColorController extends AbstractController {
       
    static public function new(){
        
        return static::_view('color/new.twig');
        
    }
    
    static public function create(){
        
        try {
           
            $service = new \App\Services\ColorService();
            $service->create(filter_body(['name', 'hex']));
            
            redirect('/color');
        }
        catch (\Exception $e) {
            
            print $e->getMessage();
            print $e->getTraceAsString();
            
            static::$flash[] = ['message' => $e->getMessage(), 'level' => 'danger'];
            
            return static::new();
        }
    }
    
    
    static public function show($id = 0){
        
        $service = new \App\Services\ColorService();
        $data = $service->find($id);
        
        if(empty($data)){
            
            // Flash messag
            redirect('/color');
        }
        
        
        return static::_view('color/show.twig', ['data' => $data]);
        
    }
    
    
    static public function edit($id = 0){
        
        $service = new \App\Services\ColorService();
        $data = $service->find($id);
        
        if(empty($data)){
            
            // Flash messag
            redirect('/color');
        }
        
        
        return static::_view('color/edit.twig', ['data' => $data]);
        
    }
    
    
    static public function update($id = 0){
        
        try {
           
            $service = new \App\Services\ColorService();
            $service->update(filter_body(['name', 'hex']), $id);
            
            redirect('/color');
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
        
        $service = new \App\Services\ColorService();
        $vars = $service->paginate();
        
        return static::_view('color/index.twig', $vars);
        
    }
}