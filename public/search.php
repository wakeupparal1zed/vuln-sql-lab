<?php
require_once __DIR__ . '/../config/db.php';

$query = $_GET['search'];

if (preg_match('/union/i', $query)) {
    exit('Запрос отклонён');
}#иначе sqlmap тут видит юнион иньекцию :( и да понимаю что блеклист не выход тк его можно обойти коментами--напримерUNION/*comment*/SELECT-- и регистром и тд и тп но тк у нас тут по тз условий таких не было я просто только от sqlmap это спрятал и норм если надо могу перелопатить

#надо time\bool
ini_set('display_errors', 0); # больше не reflected ня
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT); # теперь не будет error based
$sql = "SELECT id, qq FROM (SELECT id, qq FROM notsecret ) AS t WHERE qq = '$query'";#ААААААААЭАЭАЭАЭАЭВЭААЭВЫАЭАЭАЭ какой же костыль . ДААА ОНО ПОФИКСИЛО
$stmt = $pdo->query($sql); 

if ($stmt !== false) { 
    $results = $stmt->fetch();
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
