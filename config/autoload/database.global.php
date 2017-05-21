<?php

return [
    'db' => [
        'driver'   => 'Pdo_Mysql',
        'hostname' => getenv('MYSQL_HOST'),
        'port'     => getenv('MYSQL_PORT'),
        'database' => getenv('MYSQL_DATABASE'),
        'user'     => getenv('MYSQL_USER'),
        'password' => getenv('MYSQL_PASSWORD'),
    ],
];
