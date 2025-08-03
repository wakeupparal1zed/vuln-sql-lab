<?php

$host = getenv('DB_HOST') ?: 'db';                 
$name = getenv('DB_NAME') ?: 'taskich';
$user = getenv('DB_USER') ?: 'pguser';
$pass = getenv('POSTGRES_PASSWORD') ?: 'verysecurepasswordgagaga';

$dsn  = "pgsql:host={$host};dbname={$name};options='--client_encoding=UTF8'";

try {
    $pdo = new PDO(
        $dsn,
        $user,
        $pass,
        [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ]
    );
} catch (PDOException $e) {
    http_response_code(500);
    exit("DB connect error: " . $e->getMessage());
}
?>
