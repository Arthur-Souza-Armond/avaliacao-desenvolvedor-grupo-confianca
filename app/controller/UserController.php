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

        // Return
        dd( $user->delete($user->id) );
    }

    public function update(  ){

        // Return
        $id = $_POST[ 'id' ];

        $userModel = new UserModel();
        $user = $userModel->find( $id );

        if( empty( $user ) ){

            // error
            return;
        }

        dd( $user->update( $id, array( 'nome' => 'arthur alterado', 'email' => 'email alterado' ) ) );
    }

    private function get_users(  ){

        $usersModel = new UserModel();
        return $usersModel->paginate( 20 );
    }
}