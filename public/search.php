<?php
require __DIR__.'/../config/db.php';

$q = $_GET['search'] ?? '';
$stmt = $pdo->prepare('SELECT id, qq FROM notsecret WHERE qq ILIKE :q');
$stmt->execute([':q' => $q]);
$results = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="ru">
<head><meta charset="utf-8"><title>Результаты</title></head>
<body>
<h1>Результаты для «<?= htmlspecialchars($q) ?>»</h1>
<?php if (!$results): ?>
<p>Ничего не найдено.</p>
<?php else: ?><ul>
<?php foreach ($results as $row): ?>
<li>ID: <?= htmlspecialchars($row['id']) ?> — <?= htmlspecialchars($row['qq']) ?></li>
<?php endforeach; ?></ul><?php endif; ?>
<a href="index.php">Новый поиск</a>
</body>
</html>
