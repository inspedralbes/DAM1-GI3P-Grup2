<?php
require 'vendor/autoload.php';

$client = new MongoDB\Client("mongodb://mongo:27017");
$collection = $client->gi3p_logs->accessos;
$total = $collection->countDocuments();
$pagines = $collection->aggregate([
    ['$group' => ['_id' => '$url', 'count' => ['$sum' => 1]]],
    ['$sort' => ['count' => -1]],
    ['$limit' => 10]
]);

$per_dia = $collection->aggregate([
    ['$group' => [
        '_id' => ['$dateToString' => ['format' => '%Y-%m-%d', 'date' => '$timestamp']],
        'count' => ['$sum' => 1]
    ]],
    ['$sort' => ['_id' => -1]],
    ['$limit' => 30]
]);
?>
<?php include 'header.php'; ?>
<h1>Estadistiques d'accés</h1>
<h2>Total Accessos: <?= $total ?></h2>
<h3>Pàgines més visitades</h3>
<ul>
    <?php foreach ($pagines as $p): ?>
        <li><?= htmlspecialchars($p['_id']) ?>: <?= $p['count'] ?> accessos</li>
    <?php endforeach; ?>
</ul>
<h3>Accessos per dia</h3>
<ul>
    <?php foreach ($per_dia as $d): ?>
        <li><?= $d['_id'] ?>: <?= $d['count'] ?> accessos</li>
    <?php endforeach; ?>
</ul>
<a href="index.php" style="color : white;">Tornar</a>