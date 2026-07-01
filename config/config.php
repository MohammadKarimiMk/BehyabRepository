<?php
$config= [
    'db' => [
        'host' => 'localhost',
        'database' => 'behyabdb',
        'username' => 'root',
        'password' => ''
    ],
    'jwt_secret'=>"iran",
    //"root_route"=>dirname($_SERVER['SCRIPT_NAME']),
    "root_route"=>mb_strtolower(dirname($_SERVER['SCRIPT_NAME']), 'UTF-8'),
];