<?php

namespace app\controller;

use app\core\ControllerCore;

class SystemController extends ControllerCore{

    public function page_not_found(){
        $this->view(
            'system/404',
            array(
                'home' => BASE
            )
        );
    }

    public function method_not_supported(){
        $this->view(
            'system/405',
            array(
                'home' => BASE
            )
        );
    }
}