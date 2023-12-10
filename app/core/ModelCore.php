<?php

namespace app\core;

use app\model\UserModel;
use Exception;
use PDO;
use PDOException;

class ModelCore{

    /**
     * Propriedade para definir tabela a ser manipulada
     */
    protected $table;

    private static $connection;

    /**
     * Propriedade para controlar a query do modelo
     */
    private static $query;

    /**
     * Propriedade para definir as chaves dos dados
     */
    protected $fillable;

    /**
     * Propriedade para definir a chave principal para localizar dado
     */
    protected $primary;

    private $debug = true;
    private $server, $user, $password, $database;

    public function __construct(  )
    {
        $this->server = $_ENV['DB_HOST'];
        $this->user = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASS'];
        $this->database = $_ENV['DB_NAME'];

    }

    /**
     * Criação da conexão com o banco de dados
     * 
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
            if ($this->debug)
                echo "<b>Error on getConnection(): </b>" . $ex->getMessage() . "<br/>";

            return null;
        }
    }

    /**
     * Remover conexão
     * 
     * @return void
     */
    public function disconnect()
    {
        self::$connection = null;
    }

    /**
     * Função de modelo para remover dados
     * 
     * @param $identifier ID do termo a ser removido
     */
    public function delete( $identifier ){

        try{

            $query = "DELETE FROM $this->table WHERE $this->primary = '$identifier'";

            $this->query = $this->getConnection()->prepare( $query );

            $this->query->execute();

            return 'success';

        }catch( Exception $e ){

            echo $e->getMessage();
        }
    }

    public function find( $identifier ){

        try{

            $this->create_base_select();

            $query = $this->query->queryString . " WHERE $this->primary = '$identifier'";                                

            $this->query = $this->getConnection()->prepare( $query );

            $this->query->execute();

            return $this->serialize_data( $this->query->fetchAll( PDO::FETCH_ASSOC ) )[0];
            
        }catch( Exception $e ){

            echo $e->getMessage();
        }        
    }

    public function update( $identifier, $params ){

        try{

            $aux = '';

            foreach( $this->fillable as $key => $column ){
                $aux .= "$column = '$params[$column]'";

                if( $key != count( $params ) - 1 )
                    $aux .= ', ';
            }

            $sql = "UPDATE $this->table SET $aux WHERE $this->primary = '$identifier'";

            $this->query = $this->getConnection()->prepare( $sql );

            $this->query->execute();

            return 'success';

        }catch( PDOException $e ){

            return $e->getMessage();
        }
    }

    public function insert( $params ){

        try{

            $keysParams = implode( ',', array_keys( $params ) );
            $valuesParams = implode( "','", array_values( $params ) );

            $query = "INSERT INTO $this->table ( $keysParams ) VALUES ( '$valuesParams' )";

            $this->query = $this->getConnection()->prepare( $query );

            $this->query->execute();

            return array(
                'status' => 'success',
                'id_user' => $this->getConnection()->lastInsertId()
            );

        }catch( PDOException $e ){

            return array(
                'status' => 'error',
                'error' => $e->getMessage()
            );
        }
    }

    /**
     * Função para paginar os resultados da consulta
     * 
     * @param int Quantidade de linhas a ser buscadas
     */
    public function get(  ){

        if( $this->query == null ){

            $this->create_base_select();
        }

        $queryString = $this->query->queryString;
        $queryString .= " LIMIT 100";

        $this->query = $this->getConnection()->prepare( $queryString );

        $this->query->execute(  );

        return $this->serialize_data( $this->query->fetchAll( PDO::FETCH_ASSOC ) );
    }

    /**
     * Função para criar query de consulta no banco de dados
     * 
     * @param string $column Nome da coluna para comparação
     * @param string $operator a ser usado na consulta
     * @param string $value a ser comparado
     * 
     * @return ModelCore
     */
    public function where( $column, $operator, $value ){

        try{

            $sql = "SELECT * FROM $this->table WHERE $column $operator '$value'";

            $this->query = $this->getConnection()->prepare( $sql );

            return $this;

        }catch( Exception $e ){

            if( $this->debug )
                echo $e->getMessage();
        }        
    }

    /**
     * Função para criar uma query select base
     * 
     * @return ModelCore
     */
    private function create_base_select(  ){

        try{

            $sql = "SELECT * FROM $this->table";

            $this->query = $this->getConnection()->prepare( $sql );

            return $this;

        }catch( Exception $e ){

            if( $this->debug )
                echo $e->getMessage();
        }   
    }

    /**
     * Função para serializar dados
     * 
     * @param $data Dados do banco de dados
     * 
     * @return array
     */
    private function serialize_data( $data = [] ){

        if( empty( $data ) )
            return $data;

        $dataSerialized = array();
        foreach( $data as $d ){

            $user = new UserModel();
            foreach( $d as $key => $u ){

               $user->$key = $u;
            }

            $dataSerialized[] = $user;
        }

        return $dataSerialized;
    }

}