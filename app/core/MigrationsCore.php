<?php

namespace app\core;

use PDO;

class MigrationsCore{

    private static $connection;

    private $server, $user, $password, $database;

    private PDO $pdo;

    public function __construct()
    {
        
        /**
         * DB config
         * 
         */
        $this->server = $_ENV['DB_HOST'];
        $this->user = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASS'];
        $this->database = $_ENV['DB_NAME'];

        $migrations = $this->get_migrations();

        $this->create_tables( $migrations );

    }

    /**
     * Create a database connection or return the connection already open using Singletion Design Patern
     * @return PDOConnection|null
     */
    public function getConnection()
    {
        try {
            if (self::$connection == null) {
                self::$connection = new PDO("mysql:host={$this->server};dbname={$this->database};charset=utf8", $this->user, $this->password);
                self::$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$connection->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
                self::$connection->setAttribute(PDO::ATTR_PERSISTENT, true);
            }

            return self::$connection;
        } catch (\PDOException $ex) {
                echo "<b>Error on getConnection(): </b>" . $ex->getMessage() . "<br/>";

            return null;
        }
    }

    private function create_tables( $migrations ){

        foreach( $migrations as $migration ){

            $query = $this->getConnection()->prepare( $migration[ 'schema' ] );
            
            $query->execute();

            print_r( "\n" );
            print_r( $migration[ 'name' ] . " - Migration executed\n\n" );
        }
    }

    private function get_migrations(  ){

        $files = scandir( ROOT_DIR . '/app/migrations' );

        foreach( $files as $file ){

            if( $file === '.' || $file === '..' ){
                continue;
            }

            require_once( ROOT_DIR . '/app/migrations/' . $file );
            $className = pathinfo( $file, PATHINFO_FILENAME );
            $instance = new $className();

            $newMigrations[] = array(
                'name' => $file,
                'schema' => $instance->up()
            );
        }

        return $newMigrations;
    }

}