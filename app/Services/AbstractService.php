<?php namespace App\Services;

abstract class AbstractService {
    
    static protected $conn;
    
    /**
     * 
     * @return \PDO
     */
    static public function _pdo(){
        
        
        if (empty(static::$conn )) {

            $dsn = sprintf('mysql:host=%s;port=%s;dbname=%s', 'mysql', '3306', 'app');

            static::$conn = new \PDO($dsn, 'root', 'root');
            static::$conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
            static::$conn->setAttribute(\PDO::ATTR_AUTOCOMMIT, true);
            //print_r($conn->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN, 0));
        }

        return static::$conn ;
    }
}