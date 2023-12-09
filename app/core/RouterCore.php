<?php

namespace app\core;

use Exception;

class RouterCore{

    private $uri;
    private $method;
    private $actions = [];

    /**
     * Método chamado no index.php para inicializar rotas e criar conexão com os controladores
     * 
     * @param null
     * @return void
     */
    public function __construct(  )
    {
  
        try{

            $this->initialize(  );

            require_once( '../app/config/Router.php' );

            $this->execute(  );

        }catch( Exception $e ){

            // error handle
            echo $e->getMessage();
        }
    }

    /**
     * Método responsável por preparar a url para ser processada pelo método de execução
     * 
     * @param null
     * @return void
     */
    private function initialize(  ){

        $this->method = $_SERVER[ 'REQUEST_METHOD' ];
        $this->uri = $this->normalizeURI( $_SERVER[ 'REQUEST_URI' ] );

        if( DEBUG_URI )
            dd( $this->uri );
    }

    /**
     * Método para executar ações das rotas cadastradas previamente
     * 
     * @param null
     * @return void
     */
    private function execute(  ){

        foreach( $this->actions as $action ){

            $r = $action[ 'router' ];

            if( substr( $r, -1 ) == '/' )
                $r = substr( $r, 0, -1 );

            if( $r == $this->uri ){

                if( $this->method != $action[ 'method' ] )
                    throw new Exception( "O caminho da URL não suporta esse método de conexão - Error 405" );

                if( is_callable( $action[ 'call' ] ) ){

                    $action['call']();
                    break;
                }

                $this->execute_controller( $action[ 'call' ] );
            }
        }
    }

    /**
     * Método criado para controlar a chamada de funções para controladores
     * 
     * @param string $actionCall
     * @return 
     */
    private function execute_controller( $actionCall ){

        $ex  = explode( '@', $actionCall );
        if( !isset( $ex[ 0 ] ) || !isset( $ex[1] ) )
            throw new Exception( "Controller ou método não encontrado - Error 404" );

        $controller = 'app\\controller\\' . $ex[ 0 ];
        if( !class_exists( $controller ) )
            throw new Exception( "Controller não encontrada - Error 404" );

        if( !method_exists( $controller, $ex[ 1 ] ) )
            throw new Exception( "Método não encontrado - Error 404" );

        call_user_func_array([
            new $controller,
            $ex[ 1 ]
        ], []);
    }

    /**
     * Método criado para gerenciar a criação de rotas para serem acessadas
     * 
     * @param string $router
     * @param string $call
     * @param string $method
     * 
     * @return void
     */
    public function add_action( $router, $call, $method ){

        $this->actions[] = [
            'router' => $router,
            'call' => $call,
            'method' => $method
        ];
    }

    /**
     * Função para processar url da rota e formatar no modelo desejado para execução
     * 
     * @param string $uri
     * @return string
     */
    private function normalizeURI( $uri ){

        if( strpos( $uri, '?' ) )
            $uri = mb_substr( $uri, 0, strpos( $uri, '?' ) );

        $ex = explode( '/', $uri );
        $ex = array_values( array_filter( $ex ) );

        for( $i = 0; $i < UNSET_URI_COUNT; $i++ ){
            unset( $ex[$i] );
        }

        return implode( '/', array_values( array_filter( $ex ) ) );
    }

}