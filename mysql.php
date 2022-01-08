<?php
require 'redbean/rb-mysql.php';

$mysql = [ 
    'host' => 'localhost', // адрес сервера
    'db' => 'discord', // имя базы данных
    'user' => 'root', // имя пользователя
    'password' => '' // пароль
    ];

R::setup( 'mysql:host='. $mysql['host'] .';dbname='. $mysql['db'] .'', ''.$mysql['user'].'', ''. $mysql['password'] .'' );

if (!R::testConnection()) {
    die('Database Error! Try later...');
}