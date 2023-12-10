<?php

namespace app\controller;

use app\core\ControllerCore;
use app\model\UserModel;

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

        $id = $_POST[ 'id' ];

        $userModel = new UserModel();
        $user = $userModel->find( $id );

        if( empty( $user ) ){

            $erros = array(
                'error' => "Nenhum usuário encontrado para remoção"
            );

            return $this->response( '', $erros );
        }

        $dataUser = array(
            'nome' => $_POST[ 'nome' ],
            'email' => $_POST[ 'email' ]
        );

        $res = $user->update( $id, $dataUser );

        if( $res != 'success' )
            return $this->response( $data = array( 'error' => $res ) );

        return $this->response();
    }

    public function add_new(  ){

        $userModel = new UserModel();

        $user = array(
            'nome' => $_POST[ 'nome' ],
            'email' => $_POST[ 'email' ]
        );

        $res = $userModel->insert( $user );

        if( $res['status'] == 'error' )
            return $this->response( $data = array( 'error' => $res ) );

        $this->response();
    }

    private function get_users(  ){

        $usersModel = new UserModel();
        return $usersModel->get( 20 );
    }
}