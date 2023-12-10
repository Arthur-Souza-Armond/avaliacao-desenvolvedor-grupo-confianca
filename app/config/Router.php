<?php

/***************************
 * Responsável por criar e configurar as rotas do sistema
 ***************************/

$this->add_action( '/', 'UserController@index', "GET" );

$this->add_action( 'users/remove', 'UserController@remove', 'POST' );

$this->add_action( 'users/update', 'UserController@update', 'POST' );

$this->add_action( 'users/find', 'UserController@find', 'POST' );