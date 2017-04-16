<?php


// CREATE DATABASE "my-crud-app"
//     WITH 
//     OWNER = postgres
//     ENCODING = 'UTF8'
//     CONNECTION LIMIT = -1;

// CREATE TABLE items (
//     itemID            serial NOT NULL PRIMARY KEY,
//     name         varchar(80) NOT NULL,   
//     sort         int NOT NULL  
// );

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

