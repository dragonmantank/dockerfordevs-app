<?php

$dbHost = getenv('MYSQLSERVER_PORT_3306_TCP_ADDR');
$dbPort = getenv('MYSQLSERVER_PORT_3306_TCP_PORT');
$database = getenv('MYSQLSERVER_ENV_MYSQL_DATABASE');

return [
    'db' => [
        'driver'   => 'Pdo',
        'hostname' => $dbHost,
        'port'     => $dbPort,
        'dsn'      => sprintf('mysql:host=%s;port=%d;dbname=%s', $dbHost, $dbPort, $database),
        'database' => $database,
        'user'     => 'root',
        'password' => getenv('MYSQLSERVER_ENV_MYSQL_ROOT_PASSWORD'),
    ],
];