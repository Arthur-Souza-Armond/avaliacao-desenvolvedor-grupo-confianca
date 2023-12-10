<?php

use app\core\MigrationsCore;


require_once( 'app/config/config.php' );
require_once 'vendor/autoload.php';

$dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$migrationCore = new MigrationsCore(  );