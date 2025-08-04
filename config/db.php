<?php
$pdo = new PDO(
    "pgsql:host=db;port=5432;dbname=taskich",
    "pguser",
    "verysecurepasswordgagaga",
    [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ]
);

$pdo->exec("
CREATE TABLE IF NOT EXISTS notsecret(id SERIAL PRIMARY KEY, qq text);
CREATE TABLE IF NOT EXISTS secret(id SERIAL PRIMARY KEY, qq text);
");

if (!$pdo->query('SELECT 1 FROM notsecret LIMIT 1')->fetch()) {
    for ($i = 1; $i <= 10; $i++) $pdo->exec(\"INSERT INTO notsecret(qq) VALUES('notsecret{$i}')\");
    $pdo->exec(\"INSERT INTO secret(qq) VALUES('flag{ihopeicangetaninternship}')\");
}
