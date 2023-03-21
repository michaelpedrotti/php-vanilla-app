<?php namespace App\Services;

abstract class AbstractService {
    
    protected $conn;
    
    /**
     * 
     * @return \PDO
     */
    protected function _dal(){
        
        
        if (empty($this->conn)) {

            $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s', 'mysql', '3306', 'app');

            $this->conn = new \PDO($dsn, 'root', 'root');
            $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            $this->conn->setAttribute(\PDO::ATTR_AUTOCOMMIT, true);
            //print_r($conn->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN, 0));
        }

        return $this->conn;
    }
}