<?php

namespace app\controller;

use app\core\ControllerCore;

class UserController extends ControllerCore{

    public function index(  ){

        $this->view(
            'home/main'
        );
    }
}