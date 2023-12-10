<?php

/***************************
 * Responsável por criar e configurar as rotas do sistema
 ***************************/

$this->add_action( '/', 'UserController@index', "GET" );

$this->add_action( 'users/remove', 'UserController@remove', 'POST' );

$this->add_action( 'users/update', 'UserController@update', 'POST' );

$this->add_action( 'users/find', 'UserController@find', 'POST' );

$this->add_action( 'users/add-new', 'UserController@add_new', 'POST' );

$this->add_action( '404', function(  ){

    print_r( '404' );
}, "GET" );


$this->add_action( '405', function(  ){

    print_r( '405' );
}, "GET" );