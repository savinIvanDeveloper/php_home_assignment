<?php

function get_pdo(): PDO {
    $host = getenv('MYSQL_HOST') ?: 'localhost';
    $db   = getenv('MYSQL_DATABASE') ?: 'php_home_assignment';
    $user = getenv('MYSQL_USER') ?: 'root';
    $pass = getenv('MYSQL_PASSWORD') ?: 'root';

    $dsn = "mysql:host={$host};dbname={$db};charset=utf8mb4";
    $opts = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];
    return new PDO($dsn, $user, $pass, $opts);
}
