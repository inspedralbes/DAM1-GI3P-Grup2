<?php
require 'vendor/autoload.php';

function logAcces($url, $usuari = null) {
    $uri = getenv('MONGODB_URI');
    if (!$uri && isset($_SERVER['MONGODB_URI'])) {
        $uri = $_SERVER['MONGODB_URI'];
    }
    
    if (!$uri) {
        $uri = "mongodb://mongo:27017";
    }
    
    try {
        $client = new MongoDB\Client($uri);
        $collection = $client->gi3p_logs->accessos;
        
        $collection->insertOne([
            'url' => $url,
            'timestamp' => new MongoDB\BSON\UTCDateTime(time() * 1000),
            'ip' => $_SERVER['REMOTE_ADDR'] ?? 'unknown'
        ]);
    } catch (Exception $e) {
        error_log("MongoDB error: " . $e->getMessage());
    }
}
?>