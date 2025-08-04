<?php

$host = 'db';
$port = '5432';
$dbname = 'taskich';
$user = 'pguser';
$password = 'verysecurepasswordgagaga';

$dsn = "pgsql:host=$host;port=$port;dbname=$dbname";

$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

return new PDO($dsn, $user, $password, $options);
