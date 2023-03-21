<?php namespace App\Controllers;

class UserController extends AbstractController {
       
    static public function new(){
        
        return static::_view('user/new.twig', [
            "colors" => \App\Services\ColorService::newInstance()->all()
        ]);
        
    }
    
    static public function create(){
        
        $conn = \App\Services\AbstractService::_pdo();
        $conn->beginTransaction();
        
        try {
            
            $userId = \App\Services\UserService::newInstance()->create(filter_body(['email', 'name']));
            
            $colors = find_body('colors');

            if(!empty($colors)){
                
                $service = \App\Services\ColorService::newInstance();
            
                foreach($colors as $key => $colorId){

                  $service->createUserRelation([
                        'color_id' => $colorId, 
                        'user_id' => $userId
                  ]);   
                }
            }
            
            $conn->commit();
            
            redirect('/user');
        }
        catch (\Exception $e) {
            
            $conn->rollBack();
            
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
        
        return static::_view('user/show.twig', [
            "colors" => \App\Services\ColorService::newInstance()->all(),
            "user_colors" => $service->getColorRelations($id),
            'data' => $data
        ]);
        
    }
    
    
    static public function edit($id = 0){
        
        $service = new \App\Services\UserService();
        $data = $service->find($id);
        
        if(empty($data)){
            
            // Flash messag
            redirect('/user');
        }
        
        return static::_view('user/edit.twig', [
            'data' => $data,
            "user_colors" => $service->getColorRelations($id),
            "colors" => \App\Services\ColorService::newInstance()->all()
        ]);
        
    }
    
    
    static public function update($id = 0){
        
        $conn = \App\Services\AbstractService::_pdo();
        $conn->beginTransaction();
        
        try {
           
            \App\Services\UserService::newInstance()->update(filter_body(['email', 'name']), $id);
            
            $colors = find_body('colors');
            
            $service = \App\Services\ColorService::newInstance();
            $service->deleteUserRelation($id);

            if(!empty($colors)){
                
                foreach($colors as $key => $colorId){

                  $service->createUserRelation([
                        'color_id' => $colorId, 
                        'user_id' => $id
                  ]);   
                }
            }
            
            
            $conn->commit();
            
            redirect('/user');
        }
        catch (\Exception $e) {
            
            $conn->rollBack();
            
            print $e->getMessage();
            print $e->getTraceAsString();
            
            static::$flash[] = ['message' => $e->getMessage(), 'level' => 'danger'];
            
            return static::new();
        }
    }
    
    
    static public function delete($id){
        
        $service = new \App\Services\UserService();
        $data = $service->find($id);
        
        if(empty($data)){
            
            // Flash message
            redirect('/user');
        }
        else {
            
            $service->delete($id);
            
            redirect('/user');
        }
    }
    
    
    static public function index(){
        
        $service = new \App\Services\UserService();
        $vars = $service->paginate();
        
        
        $vars['offset'] = find_body('offset', 0);
        $vars['limit'] = find_body('limit', $vars['total'] < 10 ? $vars['total'] : 10);
        
        return static::_view('user/index.twig', $vars);
        
    }
}