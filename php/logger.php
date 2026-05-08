<?php
require 'vendor/autoload.php';

function logAcces($url, $usuari = null) {
    $client = new MongoDB\Client("mongodb://mongo:27017");
    $collection = $client->gi3p_logs->accessos;
    
    $collection->insertOne([
        'url' => $url,
        'timestamp' => new MongoDB\BSON\UTCDateTime(time() * 1000),
        'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
    ]);
}
?>