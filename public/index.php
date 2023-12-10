<?php

require_once( '../vendor/autoload.php' );
require_once( '../app/config/config.php' );
require_once( '../app/functions/functions.php' );

$dotenv = Dotenv\Dotenv::createImmutable(dirname( __DIR__ ));
$dotenv->load();

new app\core\RouterCore();