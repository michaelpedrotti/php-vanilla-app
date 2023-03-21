<?php namespace App\Services;

class UserService extends AbstractService {
    
    public function find($id = 0){

        return static::_pdo()->query('SELECT * FROM `user` WHERE `id` = '. $id)
            ->fetch(\PDO::FETCH_ASSOC);
    }
   
    public function getColorRelations($id = 0){
        
         return static::_pdo()->query('SELECT color_id FROM `user_colors` WHERE `user_id` = '. $id)
            ->fetchAll(\PDO::FETCH_COLUMN, 0);
    }
    
    public function create($data =[]){
        
        static::_pdo()
            ->prepare('INSERT INTO `user`(`email`, `name`) VALUES(?, ?)')
                ->execute(array_values($data)); 
        
        return static::_pdo()->lastInsertId();
    }
    
    public function update($data = [], $id = 0){

        $data[] = $id;

        static::_pdo()
            ->prepare('UPDATE `user` SET `email` = ?,  `name` = ? WHERE `id` = ?')
                ->execute(array_values($data));
    }
    
    public function delete($id = 0){
        
        static::_pdo()
            ->prepare('DELETE FROM `user`  WHERE `id` = ?')
                ->execute([$id]);
    }
    
    public function paginate($filter = []){
        
        $query  = 'SELECT SQL_CALC_FOUND_ROWS * FROM `user` ';
        $query .= 'ORDER BY `id` DESC ';
        $query .= sprintf('LIMIT %s, %s ', array_get($filter, 'offset', 0), array_get($filter, 'limit', 10));

        $rows = static::_pdo()->query($query)->fetchAll(\PDO::FETCH_ASSOC);
        
        $total = static::_pdo()->query('SELECT FOUND_ROWS() AS total')->fetchColumn();
        
        return [
            
            'total' => $total,
            'rows' => $rows
        ];
    }
    
    /**
     * 
     * @return self
     */
    static public function newInstance(){
        return new static();
    }
}