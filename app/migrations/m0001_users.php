<?php

use app\core\MigrationsCore;

class m0001_users extends MigrationsCore{

    public function __construct()
    {
        
    }

    protected function up(  ){

        $sql = "CREATE TABLE users (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nome VARCHAR(100) NOT NULL,
                email VARCHAR(100) NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            ) ENGINE=INNODB;";

        return $sql;
    }
}