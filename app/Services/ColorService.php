<?php namespace App\Services;

class ColorService extends AbstractService {
    
    public function find($id = 0){

        return static::_pdo()->query('SELECT * FROM `colors` WHERE `id` = '. $id)
            ->fetch(\PDO::FETCH_ASSOC);
    }
    
    public function all($data = []){
        
        $query  = 'SELECT * FROM `colors` ';
        
        $filter = [];
        
        if(array_has($data, 'user_id')){
            
            $filter[]  = 'id IN( SELECT color_id FROM `colors` WHERE user_id = ' . intval($data['user_id']) . ')';
        }
        
        if(!empty($filter)){
            
            $query .= 'WHERE ' . implode(' AND ', $filter) . ' ';
        }
        
        $query .= 'ORDER BY name DESC';
        
        
        return static::_pdo()->query($query)->fetchAll(\PDO::FETCH_ASSOC);
        
    }
    
    public function createUserRelation($data =[]){
        
        static::_pdo()
            ->prepare('INSERT INTO `user_colors`(`color_id`, `user_id`) VALUES(?, ?)')
                ->execute(array_values($data)); 
    }
    
    public function create($data =[]){
        
        static::_pdo()
            ->prepare('INSERT INTO `colors`(`name`, `hex`) VALUES(?, ?)')
                ->execute(array_values($data)); 
        
        return static::_pdo()->lastInsertId();
    }
    
    public function update($data = [], $id = 0){

        $data[] = $id;

        static::_pdo()
            ->prepare('UPDATE `colors` SET `name` = ?,  `hex` = ? WHERE `id` = ?')
                ->execute(array_values($data));
    }
    
    public function delete($id = 0){
        
        static::_pdo()
            ->prepare('DELETE FROM `user`  WHERE `id` = ?')
                ->execute([$id]);
    }
    
    
    public function deleteUserRelation($userId = 0){
        
        static::_pdo()
            ->prepare('DELETE FROM `user_colors`  WHERE `user_id` = ?')
                ->execute([$userId]);
    }
    
    public function paginate($filter = []){
        
        $query  = 'SELECT SQL_CALC_FOUND_ROWS * FROM `colors` ';
        $query .= 'ORDER BY `id` DESC ';
        $query .= sprintf('LIMIT %s, %s ', array_get($filter, 'offset', 0), array_get($filter, 'limit', 10));

        $rows = $this->_pdo()
                ->query($query)
                    ->fetchAll(\PDO::FETCH_ASSOC);
        
        $total = $this->_pdo()->query('SELECT FOUND_ROWS() AS total')->fetchColumn();
        
        return [
            
            'total' => $total,
            'rows' => $rows
        ];
    }
    
    /**
     * @return self
     */
    static public function newInstance(){
        return new static();
    }
}