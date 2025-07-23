<?php
require_once __DIR__ . '/../config/db.php';

$query = $_GET['search'];

if (preg_match('/union/i', $query)) {
    exit('Запрос отклонён');
}#иначе sqlmap тут видит юнион иньекцию :( и да понимаю что блеклист не выход тк его можно обойти коментами--напримерUNION/*comment*/SELECT-- и регистром и тд и тп но тк у нас тут по тз условий таких не было я просто только от sqlmap это спрятал и норм если надо могу перелопатить

#надо time\bool
ini_set('display_errors', 0);                 

$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);

$query = $_GET['search'] ?? '';

$sql="SELECT id, qq FROM notsecret WHERE qq = '$query'";   #

$stmt = $pdo->query($sql);


if ($stmt !== false) { 
    $results = $stmt->fetchAll();
}   else { 
    $results = [];
}
#у нас же все безопасно поэтому экранируем наш поиск енкодом хтмлы
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <title>Результаты поиска</title>
</head>
<body>
    <h1>Результаты для «<?= htmlspecialchars($query) ?>»</h1>
    <?php if (!$results): ?>
        <p>Ничего не найдено.</p>
    <?php else: ?>
         <ul>
    <?php foreach ($results as $row): ?>
        <li>ID: <?= htmlspecialchars($row['id']) ?>
            — <?= htmlspecialchars($row['qq']) ?></li>
    <?php endforeach; ?>
    </ul>
    <?php endif; ?>
    <a href="index.php"> Новый поиск</a>
</body>
</html>
