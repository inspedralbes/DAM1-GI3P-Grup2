
<!DOCTYPE html>
<html>
<head>
    <title>Estadístiques</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<h1>Estadístiques d'Accés</h1>

<?php
// Connexió a MongoDB
$uri = "mongodb://mongo:27017";
$client = new MongoDB\Client($uri);
$collection = $client->gi3p_logs->accessos;

// Dates
$data_inici = $_GET['data_inici'] ?? date('Y-m-d', strtotime('-7 days'));
$data_fi = $_GET['data_fi'] ?? date('Y-m-d');

// Filtrar
$inici = new MongoDB\BSON\UTCDateTime(strtotime($data_inici . ' 00:00:00') * 1000);
$fi = new MongoDB\BSON\UTCDateTime(strtotime($data_fi . ' 23:59:59') * 1000);
$match = ['timestamp' => ['$gte' => $inici, '$lte' => $fi]];

// Total accessos
$total = $collection->countDocuments($match);

// Tendència (accessos per dia)
$tendencia = $collection->aggregate([
    ['$match' => $match],
    ['$group' => ['_id' => ['$dateToString' => ['format' => '%Y-%m-%d', 'date' => '$timestamp']], 'count' => ['$sum' => 1]]],
    ['$sort' => ['_id' => 1]]
])->toArray();
?>

<form method="GET">
    Data inici: <input type="date" name="data_inici" value="<?= $data_inici ?>">
    Data fi: <input type="date" name="data_fi" value="<?= $data_fi ?>">
    <button type="submit">Filtrar</button>
</form>

<hr>

<!-- Resultats -->
<h3>Total accessos: <?= $total ?></h3>

<h3>Tendència</h3>
<canvas id="trendChart" width="600" height="300"></canvas>

<script>
// Dades per la gràfica
const dies = <?= json_encode(array_column($tendencia, '_id')) ?>;
const accessos = <?= json_encode(array_column($tendencia, 'count')) ?>;

// Dibuixar gràfica
new Chart(document.getElementById('trendChart'), {
    type: 'line',
    data: {
        labels: dies,
        datasets: [{
            label: 'Accessos per dia',
            data: accessos,
            borderColor: 'blue'
        }]
    }
});
</script>
</body>
</html>
