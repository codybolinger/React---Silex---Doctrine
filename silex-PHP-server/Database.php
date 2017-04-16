<?php

class Database{
    private $connection;

    public function __construct(){
        $config = new \Doctrine\DBAL\Configuration();

        $connectionParams = array(
            'dbname' => 'my-crud-app',
            'user' => 'postgres',
            'password' => 'test',
            'host' => 'localhost',
            'port' => '5432',            
            'driver' => 'pdo_pgsql',
        );
        $this->connection = \Doctrine\DBAL\DriverManager::getConnection($connectionParams, $config);
    }

    public function Query($query, $params = []){
        $statement = $this->connection->executeQuery($query, $params);
        return $statement->fetchAll();
    }
}

