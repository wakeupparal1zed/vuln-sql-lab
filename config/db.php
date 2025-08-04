<?php
$host = 'db';
$port = '5432';
$dbname = 'taskich';
$user = 'pguser';
$password = 'verysecurepasswordgagaga';

$pdo = new PDO(
    "pgsql:host=$host;port=$port;dbname=$dbname",
    $user,
    $password,
    [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]
);

$pdo->exec("
CREATE TABLE IF NOT EXISTS notsecret(
    id SERIAL PRIMARY KEY,
    qq TEXT NOT NULL
);
CREATE TABLE IF NOT EXISTS secret(
    id SERIAL PRIMARY KEY,
    qq TEXT NOT NULL
);
");

if ($pdo->query('SELECT COUNT(*) FROM notsecret')->fetchColumn() == 0) {
    $ins = $pdo->prepare('INSERT INTO notsecret(qq) VALUES(:qq)');
    for ($i = 1; $i <= 10; $i++) $ins->execute([':qq' => \"notsecret$i\"]);
    $pdo->prepare('INSERT INTO secret(qq) VALUES(:qq)')
        ->execute([':qq' => 'flag{ihopeicangetaninternship}']);
}
