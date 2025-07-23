<?php
$dbname   = 'taskich';
$user     = '123';
$password = 'verysecurepasswordgagaga';
$charset  = 'utf8mb4';

$dsn = "mysql:host=mysql;dbname=$dbname;charset=$charset";
try {#чтоб трейсбек не вывалило кучей в браузер
    $pdo = new PDO($dsn, $user, $password, [
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_BOTH,  
        PDO::ATTR_EMULATE_PREPARES   => false,            
    ]);
} catch (PDOException $e) {
    exit('DB connect failed');
}

$pdo->exec("CREATE TABLE IF NOT EXISTS notsecret (
    id INT PRIMARY KEY,
    qq VARCHAR(255)
)");

$pdo->exec("CREATE TABLE IF NOT EXISTS secret (
    id INT PRIMARY KEY, 
    qq VARCHAR(255) NOT NULL
)");

$check = $pdo->query("SELECT COUNT(*) FROM notsecret")->fetchColumn();#fix later уже забыл че тут вообще написано
if ($check == 0) {
    $pdo->exec("INSERT INTO notsecret (id, qq) VALUES
        (1, 'notsecret1'), (2, 'notsecret2'), (3, 'notsecret3'),(4, 'notsecret4'), (5, 'notsecret5'), (6, 'notsecret6'),(7, 'notsecret7'), (8, 'notsecret8'), (9, 'notsecret9'),(10, 'notsecret10')");
        
    $pdo->exec("INSERT INTO secret VALUES (1, 'flag{ihopeicangetaninternship}')");
}
