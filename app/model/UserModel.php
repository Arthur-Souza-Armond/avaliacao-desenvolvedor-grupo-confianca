<?php

namespace app\model;

use app\core\ModelCore;

class UserModel extends ModelCore{

    protected $table = 'users';

    protected $primary = 'id';

    protected $fillable = [ 'nome', 'email' ];
}