<?php
require __DIR__.'/../config/db.php';

$q = $_GET['search'] ?? '';
$sql = "SELECT id, qq FROM notsecret WHERE qq ILIKE '%$q%'";   // уязвимый запрос

$rows = $pdo->query($sql)->fetchAll();                         // если запрос плохой — выпадет исключение

?><!doctype html><html lang="ru"><head><meta charset="utf-8"><title>search</title></head><body>
<form><input name="search" value="<?=htmlspecialchars($q)?>"><button>go</button></form><hr>
<?php
if (!$rows) echo 'Ничего не найдено';
else foreach ($rows as $row) echo $row['id'].': '.htmlspecialchars($row['qq']).'<br>';
?>
</body></html>
