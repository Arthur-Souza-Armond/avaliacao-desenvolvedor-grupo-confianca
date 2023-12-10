<?php

namespace app\controller;

use app\core\ControllerCore;
use app\model\UserModel;
use Exception;

class UserController extends ControllerCore{

    public function index(  ){

        $this->view(
            'home/main',
            array(
                'users' => $this->get_users(  ),
                'urlData' => $_GET
            )
        );
    }

    public function find(  ){

        $id = $_POST[ 'id' ];

        $userModel = new UserModel();
        $result = $userModel->find( $id );

        // Return
        dd( $result->id );

    }

    public function remove(  ){
        
        $id = $_POST[ 'id' ];

        $userModel = new UserModel();
        $user = $userModel->find( $id );

        if( empty( $user ) ){

            $erros = array(
                'error' => "Nenhum usuário encontrado para remoção"
            );

            return $this->response( '', $erros );
        }

        $res = $user->delete($user->id);

        if( $res != 'success' )
            return $this->response( $data = array( 'error' => $res ) );


        return $this->response(  );
    }

    public function update(  ){

        try{

            $id = $_POST[ 'id' ];

            $userModel = new UserModel();
            $user = $userModel->find( $id );
    
            if( empty( $user ) ){
    
                $erros = array(
                    'error' => "Nenhum usuário encontrado para remoção"
                );
    
                return $this->response( '', $erros );
            }
    
            $this->check_parameters( [ $_POST[ 'nome' ], $_POST[ 'email' ] ] );
    
            $dataUser = array(
                'nome' => $_POST[ 'nome' ],
                'email' => $_POST[ 'email' ]
            );
    
            $res = $user->update( $id, $dataUser );
    
            if( $res != 'success' )
                return $this->response( $data = array( 'error' => $res ) );
    
            return $this->response();

        }catch( Exception $e ){

            return $this->response( '', array( 'error' => $e->getMessage() ) );
        }        
    }

    public function add_new(  ){

        try{

            $userModel = new UserModel();

            $this->check_parameters( [ $_POST[ 'nome' ], $_POST[ 'email' ] ] );

            $user = array(
                'nome' => $_POST[ 'nome' ],
                'email' => $_POST[ 'email' ]
            );

            $res = $userModel->insert( $user );

            if( $res['status'] == 'error' )
                return $this->response( $data = array( 'error' => $res ) );

            $this->response();
        }catch( Exception $e ){

            return $this->response( '', array( 'error' => $e->getMessage() ) );
        }
    }

    private function get_users(  ){

        $usersModel = new UserModel();
        return $usersModel->get( 20 );
    }

    private function check_parameters( array $data ){

        foreach( $data as $d ){

            if( !isset( $d ) || $d == null || $d == "" )
                throw new Exception( "Campos vazios ou inválidos" );
        }
    }
}