<?php
require 'vendor/autoload.php';
include 'header.php';

// Conectar a MongoDB
if (getenv('MONGODB_URI')) {
    $uri = getenv('MONGODB_URI');
} else {
    $uri = "mongodb://mongo:27017";
}

$client = new MongoDB\Client($uri);
$collection = $client->gi3p_logs->accessos;

$total = $collection->countDocuments();

$pagines = $collection->aggregate([
    ['$group' => ['_id' => '$url', 'count' => ['$sum' => 1]]],
    ['$sort' => ['count' => -1]],
    ['$limit' => 5]
]);

$per_dia = $collection->aggregate([
    ['$group' => [
        '_id' => ['$dateToString' => ['format' => '%Y-%m-%d', 'date' => '$timestamp']],
        'count' => ['$sum' => 1]
    ]],
    ['$sort' => ['_id' => -1]],
    ['$limit' => 7]
]);
?>

<h1>Estadístiques d'accés</h1>

<div style="max-width: 800px; margin: 2rem auto; background: white; padding: 2rem; color: black;">
    <h2 style="color: black;">Total accessos: <?= $total ?></h2>

    <h3 style="color: black;">Pàgines més visitades (top 5)</h3>
    <ul style="color: black;">
        <?php foreach ($pagines as $p): ?>
            <li style="color: black;"><?= htmlspecialchars($p['_id']) ?>: <?= $p['count'] ?> visites</li>
        <?php endforeach; ?>
    </ul>

    <h3 style="color: black;">Accessos per dia (últims 7 dies)</h3>
    <ul style="color: black;">
        <?php foreach ($per_dia as $d): ?>
            <li style="color: black;"><?= $d['_id'] ?>: <?= $d['count'] ?> accessos</li>
        <?php endforeach; ?>
    </ul>

    <a href="index.php" style="color: black;">Tornar</a>
</div>

<?php include 'footer.php'; ?>