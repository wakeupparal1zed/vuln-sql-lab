<?php
require __DIR__.'/../config/db.php';
$s=$_GET['search']??'';
$q=\"SELECT id,qq FROM notsecret WHERE qq ILIKE '%$s%'\";
$r=$pdo->query($q)->fetchAll();
?><!DOCTYPE html><html><head><meta charset="utf-8"><title>search</title></head><body>
<form><input name="search" value="<?=htmlspecialchars($s)?>"><button>go</button></form><hr>
<?php foreach($r as $row){echo $row['id'].': '.htmlspecialchars($row['qq']).'<br>';}?>
</body></html>
