<?php
require __DIR__.'/../config/db.php';

$q=$_GET['search']??'';
$sql="SELECT id,qq FROM notsecret WHERE qq ILIKE '%$q%'";  
$rows=$pdo->query($sql)->fetchAll();
?>
<!doctype html><html><head><meta charset="utf-8"><title>search</title></head><body>
<form><input name="search" value="<?=htmlspecialchars($q)?>"><button>go</button></form><hr>
<?php
if(!$rows)echo'Ничего не найдено';
else foreach($rows as $r)echo$r['id'].': '.htmlspecialchars($r['qq']).'<br>';
?>
</body></html>
