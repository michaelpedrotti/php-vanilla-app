<?php namespace App\Services;

class UserService extends AbstractService {
    
    public function find($id = 0){

        return $this->_dal()->query('SELECT * FROM `user` WHERE `id` = '. $id)
            ->fetch(\PDO::FETCH_ASSOC);
   }
    
    public function create($data =[]){
        
        $this->_dal()
            ->prepare('INSERT INTO `user`(`email`, `name`) VALUES(?, ?)')
                ->execute(array_values($data)); 
    }
    
    public function update($data = [], $id = 0){

        $data[] = $id;

        $this->_dal()
            ->prepare('UPDATE `user` SET `email` = ?,  `name` = ? WHERE `id` = ?')
                ->execute(array_values($data));
    }
    
    public function delete($id = 0){
        
        $this->_dal()
            ->prepare('DELETE FROM `user`  WHERE `id` = ?')
                ->execute([$id]);
    }
    
    public function paginate($filter = []){
        
        $query  = 'SELECT SQL_CALC_FOUND_ROWS * FROM `user` ';
        $query .= 'ORDER BY `id` DESC ';
        $query .= sprintf('LIMIT %s, %s ', array_get($filter, 'offset', 0), array_get($filter, 'limit', 10));

        $rows = $this->_dal($query)
                ->query($query)
                    ->fetchAll(\PDO::FETCH_ASSOC);
        
        $total = $this->_dal($query)->query('SELECT FOUND_ROWS() AS total')->fetchColumn();
        
        return [
            
            'total' => $total,
            'rows' => $rows
        ];
    }
}