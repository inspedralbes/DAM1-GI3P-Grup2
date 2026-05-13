<?php
require 'vendor/autoload.php';
include 'header.php';

$uri = getenv('MONGODB_URI');
if (!$uri && isset($_SERVER['MONGODB_URI'])) {
    $uri = $_SERVER['MONGODB_URI'];
}

if (!$uri) {
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

<div style="max-width: 800px; margin: 2rem auto; background: white; border-radius: 20px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); overflow: hidden;">
    <div style="background: linear-gradient(135deg, #300c55, #5e2a8c); padding: 1.5rem; text-align: center;">
        <h1 style="margin: 0; color: white;">Estadístiques d'accés</h1>
    </div>
    
    <div style="padding: 2rem;">
        <div style="background: #f5f5f5; border-radius: 15px; padding: 1.5rem; margin-bottom: 2rem; text-align: center;">
            <p style="color: #666; margin: 0; font-size: 0.9rem;">TOTAL D'ACCESSOS</p>
            <p style="color: #300c55; font-size: 3rem; font-weight: bold; margin: 0;"><?= $total ?></p>
        </div>

        <div style="background: #f5f5f5; border-radius: 15px; padding: 1.5rem; margin-bottom: 2rem;">
            <h3 style="color: #300c55; margin-top: 0;">TOP 5 PÀGINES MÉS VISITADES</h3>
            <ul style="list-style: none; padding: 0;">
                <?php foreach ($pagines as $p): ?>
                    <li style="border-bottom: 1px solid #e0e0e0; padding: 0.5rem 0; color: #333;">
                        <strong><?= htmlspecialchars($p['_id']) ?></strong> → <?= $p['count'] ?> visites
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div style="background: #f5f5f5; border-radius: 15px; padding: 1.5rem;">
            <h3 style="color: #300c55; margin-top: 0;">ACCESSOS DIARIS (ÚLTIMS 7 DIES)</h3>
            <ul style="list-style: none; padding: 0;">
                <?php foreach ($per_dia as $d): ?>
                    <li style="border-bottom: 1px solid #e0e0e0; padding: 0.5rem 0; color: #333;">
                        <strong><?= $d['_id'] ?></strong> → <?= $d['count'] ?> accessos
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>

        <div style="text-align: center; margin-top: 2rem;">
            <a href="index.php" style="background: #300c55; color: white; padding: 0.6rem 1.5rem; border-radius: 10px; text-decoration: none;">Tornar a l'inici</a>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>