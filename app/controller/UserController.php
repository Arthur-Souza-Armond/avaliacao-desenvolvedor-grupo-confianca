<?php

namespace app\controller;

use app\core\ControllerCore;

class UserController extends ControllerCore{

    public function index(  ){

        $this->view(
            'home/main',
            array(
                'users' => array(
                    array(
                        'id' => 1,
                        'nome' => "Arthur Souza Armond",
                        'email' => "asarmond82@gmail.com"
                    ),
                    array(
                        'id' => 1,
                        'nome' => "Arthur Souza Armond",
                        'email' => "asarmond82@gmail.com"
                    ),
                    array(
                        'id' => 1,
                        'nome' => "Arthur Souza Armond",
                        'email' => "asarmond82@gmail.com"
                    ),
                    array(
                        'id' => 1,
                        'nome' => "Arthur Souza Armond",
                        'email' => "asarmond82@gmail.com"
                    ),
                    array(
                        'id' => 1,
                        'nome' => "Arthur Souza Armond",
                        'email' => "asarmond82@gmail.com"
                    )
                )
            )
        );
    }
}